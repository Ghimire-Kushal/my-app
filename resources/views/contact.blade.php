@extends('layouts.frontend')

@section('content')

<section class="py-24 bg-white">

    <div class="max-w-4xl mx-auto px-6">

        {{-- Heading --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-black">
                Contact Me
            </h2>
            <p class="text-gray-600 mt-3">
                Let’s build something amazing together.
            </p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
    <p class="mb-6 text-black font-medium">
        {{ session('success') }}
    </p>
@endif

        {{-- Form Card --}}
        <div class="bg-white shadow-xl rounded-2xl p-10 border border-gray-200">

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block mb-2 font-medium text-black">
                        Name
                    </label>
                    <input type="text" name="name" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3
                                  focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                  outline-none text-black">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block mb-2 font-medium text-black">
                        Email
                    </label>
                    <input type="email" name="email" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3
                                  focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                  outline-none text-black">
                </div>

                {{-- Message --}}
                <div>
                    <label class="block mb-2 font-medium text-black">
                        Message
                    </label>
                    <textarea name="message" rows="6" required
                              class="w-full rounded-lg border border-gray-300 px-4 py-3
                                     focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                     outline-none text-black"></textarea>
                </div>

                {{-- Button --}}
                <div>
                    <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl
                                   shadow-md hover:bg-indigo-700 transition">
                        Send Message
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection