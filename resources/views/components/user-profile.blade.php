<section class="user-profile">
    <header class="brounded shadow-lg bg-white shadow-sm sm:rounded-lg flex flex-col md:flex-row md:items-center p-3 md:p-6 mb-6">
        <div class="profile-photo--wrapper w-full md:w-1/2 mb-3 md:mb-0 flex flex-col justify-center items-center">
            @if ( $user->profile_picture )
                <img src="{{ asset( 'storage/'.$user->profile_picture ) }}" class="w-full md:w-2/3 brounded shadow-lg shadow-sm" />
            @else 
                <img src="{{ asset('/assets/img/user.svg') }}" class="w-1/2 mb-3" />
            @endif
        </div>
        <h1 class="text-4xl w-full md:w-1/2">Welcome back{{ $user->name ? ' '.$user->name : '!' }}</h1>
    </header>
    <article class="mb-6">
        <h1 class="text-3xl mb-6 text-gray-500">Update your user profile</h1>
        <form action="/users/{{ $user->id }}" method="POST" class="form w-full flex flex-wrap p-3 md:p-6 rounded shadow-lg bg-white shadow-sm sm:rounded-lg">
            @csrf 
            @method('PUT')
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label mb-3 text-gray-500" for="name">Name: </label>
                <input class="md:w-8/12 border-0 border-b-2 border-gray-200 focus:outline-none" type="text" id="name" name="name" placeholder="{{ $user->name ? $user->name : '' }}" value="{{ old('name') ? old('name') : $user->name }}" />
                @error('name')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label mb-3 text-gray-500" for="uemail">Email: </label>
                <input class="md:w-8/12 border-0 border-b-2 border-gray-200 focus:outline-none" type="text" id="email" name="email" placeholder="{{ $user->email ? $user->email : '' }}" value="{{ old('email')}}" />
                @error('email')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label mb-3 text-gray-500" for="gender">Gender: </label>
                <select class="md:w-8/12 border-0 border-b-2 border-gray-200 focus:outline-none" name="gender" id="gender">
                    <option value="{{ old('gender') ? old('gender') : $user->gender }}">{{ $user->gender ? $user->gender : 'select your gender' }}</option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                    <option value="other">other</option>
                </select>
                @error('gender')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label mb-3 text-gray-500" for="birth_date">Date of birth:</label>
                <input class="md:w-8/12 border-0 border-b-2 border-gray-200 focus:outline-none" type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') ? old('birth_date') : $user->birth_date }}">
                @error('birthday')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label mb-3 text-gray-500" for="height">Height (cm):</label>
                <input class="md:w-8/12 border-0 border-b-2 border-gray-200 focus:outline-none" type="number" id="height" name="height" placeholder="{{ $user->height ? $user->height : '0.0' }}" value="{{ old('height') ? old('height') : $user->height }}">
                @error('height')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label mb-3 text-gray-500" for="height">Weight (kg):</label>
                <input class="md:w-8/12 border-0 border-b-2 border-gray-200 focus:outline-none" type="number" id="weight" name="weight" placeholder="{{ $user->weight ? $user->weight : '0.0'}}" value="{{ old('weight') ? old('weight') : $user->weight }}">
                @error('weight')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="py-3 w-full md:w-4/12 bg-blue-300 text-gray-700 rounded hover:bg-green-300 transition-colors duration-300 ease-in-out">Update your profile</button>
        </form>
    </article>
    <article class="mb-6">
        <h1 class="text-3xl mb-6 text-gray-500">Update your user profile photo</h1>
        <form action="/users/{{ $user->id }}/images" method="post" enctype="multipart/form-data" class="brounded shadow-lg bg-white shadow-sm sm:rounded-lg p-3 md:p-6 mb-6 flex flex-col">
            @csrf
            @method('PUT')
            <label for="profile-picture-file-upload" class="relative mb-3 p-3 rounded  w-full bg-gray-300 text-gray-700 hover:cursor-pointer text-center">Upload new profile photo</label>
            <input type="file" name="profile_picture" id="profile-picture-file-upload" class="hover:cursor-pointer" hidden />
            <button class="py-3 w-full bg-blue-300 text-gray-700 rounded hover:bg-green-300 transition-colors duration-300 ease-in-out" type="submit">Submit photo</button>
            @error('profile_picture')
                <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
            @enderror
        </form>
    </article>
</section>