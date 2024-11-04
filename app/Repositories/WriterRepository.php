<?php

namespace App\Repositories;

use App\Interfaces\WriterRepositoryInterface;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Support\Facades\DB;

class WriterRepository implements WriterRepositoryInterface
{
    /**
     * Retrieve all writers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWriter()
    {
        return Writer::all();
    }

    /**
     * Retrieve a writer by their ID.
     *
     * @param string $id
     * @return Writer
     */
    public function getWriterById(string $id)
    {
        return Writer::findOrFail($id);
    }

    /**
     * Create a new writer and their profile.
     *
     * @param array $data
     * @return User
     */
    public function createWriter(array $data)
    {
        DB::beginTransaction();

        $user = $this->createUser($data);

        $this->createWriterProfile($user, $data);

        DB::commit();

        return $user;
    }

    /**
     * Update an existing writer's information.
     *
     * @param array $data
     * @param string $id
     * @return Writer
     */
    public function updateWriter(array $data, string $id)
    {
        $writer = Writer::findOrFail($id);
        $writer->update($data);

        return $writer;
    }

    /**
     * Delete a writer by their ID.
     *
     * @param string $id
     * @return Writer
     */
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
