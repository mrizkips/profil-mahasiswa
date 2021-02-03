<?php

namespace App\Http\Select2;

class Select2
{
    protected $collection;

    public function __construct()
    {
        return $this->collection = collect();
    }

    public function option($id, $text)
    {
        return $this->collection->push([
            'id' => $id,
            'text' => $text,
        ]);
    }

    public function render()
    {
        return response()->json(['items' => $this->collection]);
    }
}
