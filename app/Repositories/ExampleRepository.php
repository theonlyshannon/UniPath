<?php

namespace App\Repositories;

use App\Interfaces\ExampleRepositoryInterface;
use App\Models\Example;
use Illuminate\Support\Facades\DB;

class ExampleRepository implements ExampleRepositoryInterface
{
    public function getAllExample()
    {
      return Example::all();
    }

    public function getExampleById(string $id)
    {
        return Example::find($id);
    }

    public function createExample(array $data)
    {
        DB::beginTransaction();

        try {
            $example = Example::create($data);

            DB::commit();

            return $example;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function updateExample(array $data, string $id)
    {
        DB::beginTransaction();

        try {
            $example = Example::find($id);
            $example->update($data);

            DB::commit();

            return $example;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function deleteExample(string $id)
    {
        DB::beginTransaction();

        try {
            $example = Example::find($id);
            $example->delete();

            DB::commit();

            return $example;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}
