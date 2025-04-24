@extends('layouts.default')

@section('main')
    @vite(['resources/css/tailwind.css'])


<div class="  mt-5" style="    max-width: 1200px;
    margin: 0 auto;">
    <div class="title text-4xl ">
        <h1 style="text-align: left">
            REGISTER
        </h1>
    </div>
    <div class=" border " style="    background: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
padding-left: 80px; padding-right: 80px;
">
        <h1 class="mb-4 text-3xl text-red-600 mb-6" style="color: #ff7272">Hospital Registration</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('hospital.store') }}" method="POST" class="mt-20">
            @csrf

            {{--        <!-- Row 1 -->--}}
            {{--        <div class="flex flex-row mb-4  justify-center">--}}
            {{--            <div class="basis-1/2 ">--}}
            {{--                <!-- Name -->--}}
            {{--                --}}{{--                <label for="name" class="form-label text-3xl font-bold underline">Name</label>--}}
            {{--                <input type="text"--}}
            {{--                       name="name"--}}
            {{--                       id="name"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}
            {{--                       value="{{ old('name') }}"--}}
            {{--                       PLACEHOLDER="NAME"--}}
            {{--                       required>--}}
            {{--                @error('name')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            {{--            <div class="basis-1/2">--}}
            {{--                <!-- Username for PIC -->--}}
            {{--                --}}{{--                <label for="pic_username" class="form-label">Username for PIC</label>--}}
            {{--                <input type="text"--}}
            {{--                       name="pic_username"--}}
            {{--                       id="pic_username"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}

            {{--                       value="{{ old('pic_username') }}"--}}
            {{--                       placeholder="USERNAME FRO PIC"--}}
            {{--                       required>--}}
            {{--                @error('pic_username')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}
            {{--        </div>--}}

            {{--        <!-- Row 2 -->--}}
            {{--        <div class="flex flex-row mb-4" >--}}
            {{--            <div class="basis-1/2">--}}
            {{--                <!-- Address -->--}}
            {{--                --}}{{--                <label for="address" class="form-label">Address</label>--}}
            {{--                <input type="text"--}}
            {{--                       name="address"--}}
            {{--                       id="address"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}
            {{--                       value="{{ old('address') }}"--}}
            {{--                       placeholder="ADDRESS"--}}
            {{--                       required>--}}
            {{--                @error('address')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            {{--            <div class="basis-1/2">--}}
            {{--                <!-- Password for PIC -->--}}
            {{--                --}}{{--                <label for="pic_password" class="form-label">Password for PIC</label>--}}
            {{--                <input type="password"--}}
            {{--                       name="pic_password"--}}
            {{--                       id="pic_password"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}
            {{--                       PLACEHOLDER="PASSWORD FRO PIC"--}}
            {{--                       required>--}}
            {{--                @error('pic_password')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}
            {{--        </div>--}}

            {{--        <!-- Row 3 -->--}}
            {{--        <div class="flex flex-row mb-4">--}}

            {{--            <div class="basis-1/2">--}}

            {{--                <!-- PIC's Name -->--}}
            {{--                --}}{{--                <label for="pic_name" class="form-label">PIC's Name</label>--}}
            {{--                <input type="text"--}}
            {{--                       name="pic_name"--}}
            {{--                       id="pic_name"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}
            {{--                       value="{{ old('pic_name') }}"--}}
            {{--                       PLACEHOLDER="PIC'S NAME"--}}
            {{--                       required>--}}
            {{--                @error('pic_name')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            {{--            <div class="basis-1/2">--}}

            {{--                <!-- License -->--}}
            {{--                --}}{{--                <label for="license" class="form-label">License</label>--}}
            {{--                <select name="license" id="license" class="form-select form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}
            {{--                        required>--}}
            {{--                    <option value="">SELECT</option>--}}
            {{--                    <option value="free" {{ old('license') == 'free' ? 'selected' : '' }}>Free Tier</option>--}}
            {{--                    <option value="monthly" {{ old('license') == 'monthly' ? 'selected' : '' }}>Monthly Subscription</option>--}}
            {{--                    <option value="yearly" {{ old('license') == 'yearly' ? 'selected' : '' }}>Yearly Subscription</option>--}}
            {{--                    <option value="business" {{ old('license') == 'business' ? 'selected' : '' }}>Business</option>--}}
            {{--                </select>--}}
            {{--                @error('license')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}
            {{--        </div>--}}

            {{--        <!-- Row 4 -->--}}
            {{--        <div class="flex flex-row mb-4">--}}

            {{--            <div class="basis-1/2">--}}

            {{--                <!-- PIC's Contact -->--}}
            {{--                --}}{{--                <label for="pic_contact" class="form-label">PIC's Contact</label>--}}
            {{--                <input type="text"--}}
            {{--                       name="pic_contact"--}}
            {{--                       id="pic_contact"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}
            {{--                       --}}{{--                       class="form-control"--}}
            {{--                       PLACEHOLDER="PIC's Contact"--}}
            {{--                       value="{{ old('pic_contact') }}"--}}
            {{--                       required>--}}
            {{--                @error('pic_contact')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            {{--            <div class="basis-1/2">--}}

            {{--                <!-- Secondary Contact -->--}}
            {{--                --}}{{--                <label for="secondary_contact" class="form-label">Secondary Contact</label>--}}
            {{--                <input type="text"--}}
            {{--                       name="secondary_contact"--}}
            {{--                       id="secondary_contact"--}}
            {{--                       class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"--}}

            {{--                       value="{{ old('secondary_contact') }}"--}}
            {{--                       PLACEHOLDER="Secondary Contact">--}}
            {{--                @error('secondary_contact')--}}
            {{--                <small class="text-danger">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}
            {{--        </div>--}}

            {{--        <!-- Save Button -->--}}
            {{--        <div class="mt-4">--}}
            {{--            <button type="submit" class="btn btn-primary">Save</button>--}}
            {{--        </div>--}}



            <!-- Row 1 -->
            <div class="flex flex-row mb-4  justify-center">
                <div class="basis-1/2 ">
                    <div>
                        <!-- Name -->
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"
                               value="{{ old('name') }}"
                               PLACEHOLDER="NAME"
                               required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex mt-4">
                        <input type="text"
                               name="address"
                               id="address"
                               class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"
                               value="{{ old('address') }}"
                               placeholder="ADDRESS"
                               required>
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="flex mt-4">
                        <!-- PIC's Name -->
                        {{--                <label for="pic_name" class="form-label">PIC's Name</label>--}}
                        <input type="text"
                               name="pic_name"
                               id="pic_name"
                               class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"
                               value="{{ old('pic_name') }}"
                               PLACEHOLDER="PIC'S NAME"
                               required>
                        @error('pic_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex mt-4">
                        <!-- PIC's Contact -->
                        {{--                <label for="pic_contact" class="form-label">PIC's Contact</label>--}}
                        <input type="text"
                               name="pic_contact"
                               id="pic_contact"
                               class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"
                               {{--                       class="form-control"--}}
                               PLACEHOLDER="PIC'S CONTACT"
                               value="{{ old('pic_contact') }}"
                               required>
                        @error('pic_contact')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex mt-4">
                        <!-- PIC's Contact -->
                        {{--                <label for="pic_contact" class="form-label">PIC's Contact</label>--}}
                        <input type="text"
                               name="secondary_contact"
                               id="secondary_contact"
                               class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"
                               {{--                       class="form-control"--}}
                               PLACEHOLDER="SECONDARY CONTACT"
                               value="{{ old('secondary_contact') }}"
                               required>
                        @error('secondary_contact')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="basis-1/2">
                    <div class="">
                        <!-- Username for PIC -->
                        {{--                <label for="pic_username" class="form-label">Username for PIC</label>--}}
                        <input type="text"
                               name="pic_username"
                               id="pic_username"
                               class="form-control w-80 px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"

                               value="{{ old('pic_username') }}"
                               placeholder="USERNAME FRO PIC"
                               required>
                        @error('pic_username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <!-- Password for PIC -->
                        {{--                <label for="pic_password" class="form-label">Password for PIC</label>--}}
                        <input type="password"
                               name="pic_password"
                               id="pic_password"
                               class="form-control w-80   px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0"
                               PLACEHOLDER="PASSWORD FRO PIC"
                               required>
                        @error('pic_password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-row mt-4">
                        <div class="w-38">
                            <!-- License -->
                            {{--                <label for="license" class="form-label">License</label>--}}
                            <select name="license" id="license" class="form-select w-full form-control px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0 text-gray-400 "
                                    required>
                                <option class="border-gray-400 border-b border bg-white" value="">LICENSE</option>
                                <option class="border-gray-400  bg-white" value="free" {{ old('license') == 'free' ? 'selected' : '' }}>Free Tier</option>
                                <option class="border-gray-400  bg-white" value="monthly" {{ old('license') == 'monthly' ? 'selected' : '' }}>Monthly Subscription</option>
                                <option class="border-gray-400  bg-white" value="yearly" {{ old('license') == 'yearly' ? 'selected' : '' }}>Yearly Subscription</option>
                                <option class="border-gray-400  bg-white" value="business" {{ old('license') == 'business' ? 'selected' : '' }}>Business</option>
                            </select>
                            @error('license')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="w-38  ml-4 ">
                            <!-- License -->
                            {{--                <label for="license" class="form-label">License</label>--}}
                            <select name="time_period" id="time_period"  class="form-select form-control w-full    px-3 py-2 placeholder:text-sm bg-gray-50 placeholder:text-gray-400 border rounded-md border-gray-300 focus-visible:border-gray-400 focus-visible:outline-0 text-gray-400 pr-2 pl-2 "
                                    required>
                                <option value="">TIME_PERIOD</option>
                                <option value="free" {{ old('license') == 'free' ? 'selected' : '' }}>Free Tier</option>
                                <option value="monthly" {{ old('license') == 'monthly' ? 'selected' : '' }}>Monthly Subscription</option>
                                <option value="yearly" {{ old('license') == 'yearly' ? 'selected' : '' }}>Yearly Subscription</option>
                                <option value="business" {{ old('license') == 'business' ? 'selected' : '' }}>Business</option>
                            </select>
                            @error('license')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <!-- Save Button -->
            <div class="mt-4 text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>

</div>



@endsection
