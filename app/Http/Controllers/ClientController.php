<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Mostrar un listado de clientes.
     */
    public function index()
    {
        $clients = Client::withCount('stockExits')->get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Mostrar el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Almacenar un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:clients',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Client::create($validated);
        
        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Mostrar un cliente específico.
     */
    public function show(Client $client)
    {
        $client->load('stockExits.product');
        return view('clients.show', compact('client'));
    }

    /**
     * Mostrar el formulario para editar un cliente.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Actualizar un cliente específico en la base de datos.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $client->update($validated);
        
        return redirect()->route('clients.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Eliminar un cliente específico de la base de datos.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        
        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}