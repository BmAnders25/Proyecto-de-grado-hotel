<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Habitacion;

class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-facturas|crear-facturas|editar-facturas|borrar-facturas', ['only' => ['index']]);
        $this->middleware('permission:crear-facturas', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-facturas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-facturas', ['only' => ['destroy']]);
    }

    public function index()
    {
        $facturas = Factura::with('cliente', 'habitacion')->latest()->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $habitaciones = Habitacion::orderBy('numero')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('facturas.create', compact('clientes', 'habitaciones', 'productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_emision' => 'required|date',
            'numero_factura' => 'required|unique:facturas,numero_factura',
            'detalles' => 'required|array|min:1',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|integer|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($data) {
            $subtotal = collect($data['detalles'])->sum(fn($d) => $d['cantidad'] * $d['precio_unitario']);
            $iva = round($subtotal * 0.19, 2);
            $total = $subtotal + $iva;

            $factura = Factura::create([
                'cliente_id' => $data['cliente_id'],
                'habitacion_id' => $data['habitacion_id'],
                'fecha_emision' => $data['fecha_emision'],
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total,
                'numero_factura' => $data['numero_factura'],
            ]);

            foreach ($data['detalles'] as $d) {
                $factura->detalles()->create([
                    'producto_id' => $d['producto_id'],
                    'cantidad' => $d['cantidad'],
                    'precio_unitario' => $d['precio_unitario'],
                    'total_linea' => $d['cantidad'] * $d['precio_unitario'],
                ]);
            }
        });

        return redirect()->route('facturas.index')->with('success', 'Factura creada correctamente.');
    }

    public function show($id)
    {
        $factura = Factura::with(['cliente', 'habitacion', 'detalles.producto'])->findOrFail($id);
        return view('facturas.show', compact('factura'));
    }

    public function edit($id)
    {
        $factura = Factura::with(['detalles'])->findOrFail($id);
        $clientes = Cliente::orderBy('nombre')->get();
        $habitaciones = Habitacion::orderBy('numero')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('facturas.edit', compact('factura', 'clientes', 'habitaciones', 'productos'));
    }

   public function update(Request $request, $id)
{
    // Validación más flexible
    $this->validateRequest($request);

    $factura = Factura::findOrFail($id);
    $factura->update($request->only(['cliente_id', 'fecha', 'total', 'estado']));

    // Eliminar los detalles existentes para volverlos a registrar
    $factura->detalles()->delete();

    // Solo crear detalles válidos (evita filas vacías)
    if ($request->has('detalles')) {
        foreach ($request->detalles as $detalle) {
            if (
                !empty($detalle['producto_id']) &&
                !empty($detalle['cantidad']) &&
                !empty($detalle['precio_unitario'])
            ) {
                $factura->detalles()->create([
                    'producto_id' => $detalle['producto_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                ]);
            }
        }
    }

    return redirect()->route('facturas.index')
        ->with('success', 'Factura actualizada correctamente.');
}




    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }

    public function descargarPDF($id)
    {
        $factura = Factura::with(['cliente', 'habitacion', 'detalles.producto', 'user'])->findOrFail($id);

        $pdf = PDF::loadView('facturas.pdf', compact('factura'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("factura-{$factura->numero_factura}.pdf");
    }

    private function validateRequest(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'fecha' => 'required|date',
        'total' => 'nullable|numeric|min:0',
        'estado' => 'nullable|string|max:20',
        'detalles' => 'nullable|array', // ya no es required
        'detalles.*.producto_id' => 'nullable|exists:productos,id',
        'detalles.*.cantidad' => 'nullable|numeric|min:0.01',
        'detalles.*.precio_unitario' => 'nullable|numeric|min:0',
    ]);
}
}