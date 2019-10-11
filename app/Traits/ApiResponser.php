<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function showAll($collection, $code = 200) 
    {
        $collection = $this->search($collection);
        $collection = $this->filterData($collection);
        $collection = $this->sortData($collection);
        $collection = $this->paginate($collection);

        return $this->successResponse($collection, $code);
    }


    protected function sortData($collection)
    {
        if(request()->has('sort_by'))
        {
            $attribute = request()->sort_by;

            $collection = $collection->sortBy($attribute)->all();
        }

        return $collection;
    }

    protected function filterData($collection)
    {
        foreach(request()->query() as $attribute => $value)
        {
            if(isset($collection->first()[$attribute]))
            {
                $collection = $collection->where($attribute, $value);
            }
        }

        return $collection;
    }

    protected function paginate($collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = request()->input('limit', 20);

        $results = array_slice($collection, ($page -1) * $perPage, $perPage);

        $paginated = new LengthAwarePaginator($results, count($collection), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPage(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }

    protected function search($collection)
    {
        if(request()->has('q'))
        {
            $name = request()->q;
            $collection = $collection->filter(function ($instance) use ($name) {
                return false !== stristr($instance->name, $name);
            });
            
        }

        return $collection;
    }
}