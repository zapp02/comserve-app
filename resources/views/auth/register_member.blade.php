<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/output.css">
    <title>Register Page</title>
</head>

<body>
    <div class="flex py-10 md:py-20 px-5 md:px-32 bg-gray-200 min-h-screen">
        <div class="flex shadow w-full flex-col-reverse lg:flex-row">
            <div class="w-full lg:w-1/2 bg-white p-10 px-5 md:px-20">
                <h1 class="font-bold text-xl text-gray-700">Register Page</h1>
                <p class="text-gray-600">Please fill all column to create your account!</p>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong style="color:red">Failed</strong>
                    <p style="color:red">{{ $errors->first() }}</p>
                </div>
                @endif
                <form action="/register_member" class="mt-10" method="POST">
                    @csrf
                    <div class="my-3">
                        <label class="font-semibold" for="member_name">Member Name</label>
                        <input required type="text" placeholder="Member Name" name="member_name" id="member_name"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="id_binusian">Binusian ID</label>
                        <input required type="text" placeholder="Binusian ID" name="id_binusian" id="id_binusian"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="major">Major</label>
                        <select required type="text" placeholder="Major" name="major" id="major"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                            <option value="Computer Science">Computer Science</option>
                            <option value="Creativepreneurship">Creativepreneurship</option>
                            <option value="Creativepreneurship">Visual Communication Design</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="address">Address</label>
                        <input required type="text" placeholder="Address" name="address" id="address"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="phone_number">Phone Number</label>
                        <input required type="text" placeholder="Phone Number" name="phone_number" id="phone_number"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="email">E-Mail</label>
                        <input required type="text" placeholder="E-Mail" name="email" id="email"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="pts">ComServe Points</label>
                        <input required type="number" placeholder="ComServe Points" name="pts" id="pts"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full" min="0" max="50">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="password">Password</label>
                        <input required type="password" placeholder="Password" name="password" id="password"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="confirm_password">Confirm Password</label>
                        <input required type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-5">
                        <button type="submit"
                            class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">REGISTER</button>
                    </div>
                </form>
                <span>Have an account? <a href="/login_member" class="text-blue-400 hover:text-blue-600">Login here.</a></span>
            </div>
            <div class="w-full lg:w-1/2 bg-blue-400 flex justify-center items-center">
                <img src="/assets/register.svg" alt="Login Image" class="w-full">
            </div>
        </div>
    </div>
    <script src="/sbadmin2/vendor/jquery/jquery.min.js"></script>
</body>

</html>
