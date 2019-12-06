<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait ApiControllerTrait
{
    public function index(Request $request)
    {
        $data = $request->all();

        $limit = $data['limit'] ?? 20;
        $order = $data['order'] ?? null;

        if ($order !== null) {
            $order = explode(',', $order);
        }

        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';

        $users = $this->model
            ->orderBy($order[0], $order[1])
            ->with($this->relationships())
            ->paginate($limit);
        return response()->json($users);
    }

    public function show($id)
    {
        $result = $this->model
            ->with($this->relationships())
            ->findOrFail($id);
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $result = $this->model->create($request->all());
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $result = $this->model->findOrFail($id);
        $result->update($request->all());

        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();

        return response()->json($result);
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }
}
