<?php
namespace App\Repositories;

use Storage;
use App\User;
use Illuminate\Http\UploadedFile;

class UsersRepo extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function addAvatar($user_id, UploadedFile $image)
    {
        $user = $this->find($user_id);

        if (null !== $user) {
            $file = Storage::disk('avatars')->putFileAs($user->id, $image, $image->name);

            return $this->saveDocumentToDB($file, $user);
        }

        return false;
    }

    public function saveDocumentToDB($file, User $owner)
    {
        $path = 'public/users';

        return $owner->image()->create([
            'path' => $path,
            'filename' => $file,
            'active' => 1
        ]);
    }

    public function getAvatar($user_id)
    {
        $filename = optional($this->find($user_id)->image->first())->filename;

        if (Storage::disk('avatars')->exists($filename)) {
            return $filename;
        }

        //return default image if no avatar
        return 'default.jpg';
    }

}