<?php

namespace App\Repositories;

use App\Interfaces\WriterRepositoryInterface;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Support\Facades\DB;

class WriterRepository implements WriterRepositoryInterface
{
    public function getAllWriter()
    {
        return Writer::all();
    }

    public function getWriterById(string $id)
    {
        return Writer::findOrFail($id);
    }

    public function createWriter(array $data)
    {
        DB::beginTransaction();

        $user = $this->createUser($data);

        $this->createWriterProfile($user, $data);

        DB::commit();

        return $user;
    }

    public function updateWriter(array $data, string $id)
    {
        $writer = Writer::findOrFail($id);
        $writer->update($data);

        return $writer;
    }

    public function deleteWriter(string $id)
    {
        $writer = Writer::findOrFail($id);
        $writer->delete();

        return $writer;
    }

    private function generateUsername(string $email)
    {
        return strstr($email, '@', true) . Writer::count();
    }

    private function createUser(array $data)
    {
        $user = User::create($data);

        $user->assignRole('writer');

        return $user;
    }

    private function createWriterProfile(User $user, array $data)
    {
        $user->writer()->create([
            'name' => $data['name'],
            'username' => $this->generateUsername($data['email']),
            'profile_picture' => $data['profile_picture']->store('assets/writer', 'public'),
        ]);
    }
}
