<?php

namespace App\Repositories;

use App\Interfaces\MentorRepositoryInterface;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MentorRepository implements MentorRepositoryInterface
{
    public function getAllMentor(?int $perPage = null)
    {
        $mentors = Mentor::query();

        return $mentors->paginate($perPage);
    }

    public function getMentorByUsername(string $username)
    {
        return Mentor::where('username', $username)->first();
    }

    public function getMentorById(string $id)
    {
        return Mentor::findOrFail($id);
    }

    public function createMentor(array $data)
    {
        DB::beginTransaction();

        $user = $this->createUser($data);

        $this->createMentorProfile($user, $data);

        DB::commit();

        return $user;
    }

    public function updateMentor(array $data, string $id)
    {
        DB::beginTransaction();

        $mentor = $this->getMentorById($id);

        $user = $this->updateUser($data, $mentor->user_id);

        $this->updateMentorProfile($user, $data);

        DB::commit();

        return $user;
    }

    public function deleteMentor(string $id)
    {
        $mentor = $this->getMentorById($id);

        $mentor->delete();

        return $mentor;
    }

    private function createUser(array $data): User
    {
        $user = User::create($data);

        $user->assignRole('mentor');

        return $user;
    }

    private function updateUser(array $data, string $id): User
    {
        $user = User::findOrFail($id);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);

        return $user;
    }


    private function generateUsername(string $email): string
    {
        return strstr($email, '@', true) . Mentor::count();
    }

    private function createMentorProfile(User $user, array $data): void
    {
        $user->mentor()->create([
            'profile_picture' => $data['profile_picture']->store('assets/images/mentors', 'public'),
            'name' => $data['name'],
            'username' => $this->generateUsername($data['email']),
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'specialization' => $data['specialization'],
            'bio' => $data['bio'],
        ]);
    }

    private function updateMentorProfile(User $user, array $data): void
    {
        $user->mentor()->update([
            'profile_picture' => isset($data['profile_picture']) ? $data['profile_picture']->store('assets/images/mentors', 'public') : $user->mentor->profile_picture,
            'name' => $data['name'],
            'username' => $this->generateUsername($data['email']),
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'specialization' => $data['specialization'],
            'bio' => $data['bio'],
        ]);
    }
}
