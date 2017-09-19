<?php
namespace App\Repositories;

use App\User;
use Illuminate\Http\UploadedFile;
use Storage;

class UsersRepo extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function createUser($data)
    {
        return $this->create($data);
    }

    public function addImage($id, UploadedFile $image)
    {
        $user = $this->find($id);

        if (null !== $user) {
            $file = Storage::disk('avatars')->putFileAs($user->id, $image, $image->name);
            $document = $this->saveToDB($file, $user);
        }

    }

    public function saveToDB($file, User $owner)
    {

        $path = 'public/users';

        return $owner->image()->create([
            'path' => $path,
            'filename' => $file,
            'active' => 1
        ]);
    }

}