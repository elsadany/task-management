<?php
namespace App\services;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        // Business logic for user creation
        return $this->userRepository->create($data);
    }
    public function login(array $data)
    {
        // Business logic for user Login
        $user = $this->userRepository->findByEmail($data['email']);

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null; // Invalid credentials
        }

        // Generate a new access token
        $token = $user->createToken('personal access token')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token,
        ];
    }

    public function updateUserProfile($id, array $data)
    {
        // Business logic for updating user profile
        return $this->userRepository->update($id, $data);
    }

    function logout($user)
    {
        // Business logic for user logout
       $user->currentAccessToken()->delete();
    }

    function index(array $filters = [])
    {
        return UserResource::collection($this->userRepository->all($filters))->response()->getData(true);
    }
}
