        if ($request->file('avatar_path')) {
            $user = User::find(\Auth::user()->id);
            $input_file = Input::file('avatar_path');
            $path = public_path('/storage/'. $users->avatar_path);

            $users->avatar_path = Image::make($input_file->getRealPath())->resize(720, 720, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(720, 720)->save($path);

            // $users->avatar_path = Image::make($input_file->getRealPath())->fit(720, 720)
            // ->crop(720, 720)->save($path);
            // $path = $request->file('avatar_path')->store('avatar');