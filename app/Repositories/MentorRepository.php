<?php

namespace App\Repositories;

use App\Interfaces\MentorRepositoryInterface;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MentorRepository implements MentorRepositoryInterface
{
    /**
     * Retrieve all mentors with optional pagination.
     *
     * @param int|null $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllMentor(?int $perPage = null)
    {
        $mentors = Mentor::query();

        return $mentors->paginate($perPage);
    }

    /**
     * Retrieve a mentor by their username.
     *
     * @param string $username
     * @return Mentor|null
     */
    public function getMentorByUsername(string $username)
    {
        return Mentor::where('username', $username)->first();
    }

    /**
     * Retrieve a mentor by their ID.
     *
     * @param string $id
     * @return Mentor
     */
    public function getMentorById(string $id)
    {
        return Mentor::findOrFail($id);
    }

    /**
     * Create a new mentor and their profile.
     *
     * @param array $data
     * @return User
     */
    public function createMentor(array $data)
    {
        DB::beginTransaction();

        $user = $this->createUser($data);

        $this->createMentorProfile($user, $data);

        DB::commit();

        return $user;
    }

    /**
     * Update an existing mentor's information.
     *
     * @param array $data
     * @param string $id
     * @return User
     */
    public function updateMentor(array $data, string $id)
    {
        DB::beginTransaction();

        $mentor = $this->getMentorById($id);

        $user = $this->updateUser($data, $mentor->user_id);

        $this->updateMentorProfile($user, $data);

        DB::commit();

        return $user;
    }

    /**
     * Delete a mentor by their ID.
     *
     * @param string $id
     * @return Mentor
     */
    public function deleteMentor(string $id)
    {
        $mentor = $this->getMentorById($id);

        $mentor->delete();

        return $mentor;
    }

    /**
     * Create a new user and assign the 'mentor' role.
     *
     * @param array $data
     * @return User
     */
    private function createUser(array $data): User
    {
        $user = User::create($data);

        $user->assignRole('mentor');

        return $user;
    }

    /**
     * Update an existing user's information.
     *
     * @param array $data
     * @param string $id
     * @return User
     */
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

    /**
     * Generate a unique username based on the user's email.
     *
     * @param string $email
     * @return string
     */
    private function generateUsername(string $email): string
    {
        return strstr($email, '@', true) . Mentor::count();
    }

    /**
     * Create a mentor profile associated with the user.
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    private function createMentorProfile(User $user, array $data): void
    {
        $user->mentor()->create([
            'profile_picture' => $data['profile_picture']->store('assets/images/mentors', 'public'),
            'name' => $data['name'],
            'username' => $this->generateUsername($data['email']),
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'degree' => $data['degree'],
            'bio' => $data['bio'],
        ]);
    }

    /**
     * Update the mentor profile associated with the user.
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    private function updateMentorProfile(User $user, array $data): void
    {
        $user->mentor()->update([
            'profile_picture' => isset($data['profile_picture']) ? $data['profile_picture']->store('assets/images/mentors', 'public') : $user->mentor->profile_picture,
            'name' => $data['name'],
            'username' => $this->generateUsername($data['email']),
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'degree' => $data['degree'],
            'bio' => $data['bio'],
        ]);
    }
}
