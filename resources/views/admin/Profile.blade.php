@extends('layout.admindashboard')

@section('title','Admin Profile')

@section('content')

<style>
.profile-card{
    max-width: 700px;
    margin: auto;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    background: #fff;
}

.profile-img{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ddd;
}

.img-wrapper{
    position: relative;
    width: 120px;
    margin: auto;
}

.camera-icon{
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #0d6efd;
    color: #fff;
    border-radius: 50%;
    padding: 6px;
    cursor: pointer;
}
</style>

<div class="profile-card">

    <h4 class="text-center mb-4">Admin Profile</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- PROFILE IMAGE --}}
        <div class="text-center mb-3">

            <div class="img-wrapper">
                <img src="{{ asset($admin->profile_photo ?? 'default.png') }}"
                     class="profile-img" id="previewImg">

                <label for="profile_photo" class="camera-icon">
                    <i class="bi bi-camera"></i>
                </label>

              <input type="file" name="profile_photo" id="profile_photo" hidden>

@error('profile_photo')
    <div class="text-danger text-center mt-2">{{ $message }}</div>
@enderror
            </div>

        </div>

        {{-- NAME --}}
       <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name"
           value="{{ old('name', $admin->name) }}"
           class="form-control @error('name') is-invalid @enderror">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        {{-- EMAIL --}}
       <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email"
           value="{{ old('email', $admin->email) }}"
           class="form-control @error('email') is-invalid @enderror">

    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        {{-- PHONE --}}
    <div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone"
           value="{{ old('phone', $admin->phone) }}"
           class="form-control @error('phone') is-invalid @enderror">

    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        {{-- ADDRESS --}}
      <div class="mb-3">
    <label>Address</label>
    <textarea name="address"
              class="form-control @error('address') is-invalid @enderror">{{ old('address', $admin->address) }}</textarea>

    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        <button class="btn btn-primary w-100">Update Profile</button>

    </form>
</div>

{{-- IMAGE PREVIEW --}}
<script>
document.getElementById('profile_photo').addEventListener('change', function(e){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImg').src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>

@endsection