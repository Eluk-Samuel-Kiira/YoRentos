@include('layouts.header')
<title>My Units | YoRentos</title>
@include('layouts.menu')
<section class="find_section ">
    <div class="container">
        <form action="">
            <div class="container-header">
                <h2 class="rental_heading">
                    {{__('Your Profile')}}
                </h2>
            </div>
            <div class="form-row">
                <div class="profile-card">
                    <div class="profile-details">
                        <div class="profile-header">
                            <img src="profile-picture.jpg" alt="Profile Picture" class="profile-image">
                        </div>
                        <div class="profile-info">
                            <label for="location">Name:</label>
                            <input type="text" name="location" value="{{ $user_profile->name }}">
                        </div>
                        <div class="profile-info">
                            <label for="location">Telephone:</label>
                            <input type="text" name="location" value="{{ $user_profile->phone_number }}">
                        </div>
                        <div class="profile-info">
                            <label for="location">Email:</label>
                            <input type="text" name="location" value="{{ $user_profile->email }}" disabled>
                        </div>
                    </div>
                    <div class="profile-details">
                        <div class="profile-info">
                            <label for="location">User Role:</label>
                            <input type="text" name="location" value="{{ $user_profile->role }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@include('layouts.footer')