<section class="user-profile">
    <article class="profile">
        <h1 class="text-3xl mb-6 text-gray-500">Update your user profile</h1>
        <form action="/users/{{ $user->id }}" method="POST" class="form w-100 flex flex-wrap p-3 md:p-6 bg-gray-100 rounded shadow-lg">
            @csrf
            @method('PUT')
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label text-gray-500" for="name">Name: </label>
                <input class="md:w-8/12 border-transparent rounded"  type="text" id="name" name="name" placeholder="{{ $user->name ? $user->name : '' }}" value="{{ old('name') }}" />
                @error('name')
                    <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label text-gray-500" for="uemail">Email: </label>
                <input class="md:w-8/12 border-transparent rounded"  type="text" id="email" name="email" placeholder="{{ $user->email ? $user->email : '' }}" value="{{ old('email') }}"/>
                @error('email')
                    <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label text-gray-500" for="gender">Gender: </label>
                <select class="md:w-8/12 border-transparent rounded" name="gender" id="gender">
                    <option value="{{ old('gender') }}">{{ $user->gender ? $user->gender : 'optional: select your gender' }}</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                @error('gender')
                    <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label text-gray-500" for="birth_date">Date of birth:</label>
                <input class="md:w-8/12 border-transparent rounded" type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                @error('birthday')
                    <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label text-gray-500" for="height">Height (cm):</label>
                <input class="md:w-8/12 border-transparent rounded" type="number" id="height" name="height" placeholder="{{ $user->height ? $user->height : '0.0' }}" value="{{ old('height') }}">
                @error('height')
                    <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-field w-full md:w-1/2 inline-flex flex-col py-3 mb-3 md:mb-6 mx-0">
                <label class="form-label text-gray-500" for="height">Weight (kg):</label>
                <input class="md:w-8/12 border-transparent rounded" type="number" id="weight" name="weight" placeholder="{{ $user->weight ? $user->weight : '0.0'}}" value="{{ old('weight') }}">
                @error('weight')
                    <p class="text-red-900 mt-4 mb-4">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="py-3 w-full md:w-4/12 bg-green-400 text-gray-500 rounded">Update your profile</button>
        </form>
    </article>
</section>
