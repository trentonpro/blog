@extends('partials.layout')
@section('content')
    <main class="mx-auto flex max-w-4xl flex-col gap-6 px-4 py-8">
            <h1 id="bootstrap-button-heading" class="text-2xl font-bold">Nupud</h1>

            <div class="flex flex-wrap items-center gap-4">
                <button type="button"
                    class="inline-block cursor-pointer select-none rounded-md border border-[#0d6efd] bg-[#0d6efd] px-3 py-1.5 text-center align-middle font-[system-ui] text-base leading-6 font-normal text-white transition-colors duration-150 enabled:hover:border-[#0a58ca] enabled:hover:bg-[#0b5ed7] enabled:active:border-[#0a53be] enabled:active:bg-[#0a58ca] focus-visible:border-[#0a58ca] focus-visible:bg-[#0b5ed7] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#3184fd]/50 disabled:pointer-events-none disabled:opacity-[0.65] motion-reduce:transition-none">
                    Primary
                </button>
                <button type="button" disabled
                    class="inline-block cursor-pointer select-none rounded-md border border-[#0d6efd] bg-[#0d6efd] px-3 py-1.5 text-center align-middle font-[system-ui] text-base leading-6 font-normal text-white transition-colors duration-150 enabled:hover:border-[#0a58ca] enabled:hover:bg-[#0b5ed7] enabled:active:border-[#0a53be] enabled:active:bg-[#0a58ca] focus-visible:border-[#0a58ca] focus-visible:bg-[#0b5ed7] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#3184fd]/50 disabled:pointer-events-none disabled:opacity-[0.65] motion-reduce:transition-none">
                    Primary (disabled)
                </button>
            </div>
            <div class="flex flex-wrap items-center gap-4">
                <button type="button" class="border-2 text-white bg-blue-400">Hello</button>
                <div class="inline-flex">
                    <button type="button"
                        class="rounded-s-sm border border-gray-200 px-3 py-2 font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:z-10 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white focus:outline-none disabled:pointer-events-auto disabled:opacity-50">
                        View
                    </button>
                    <button type="button"
                        class="-ms-px border border-gray-200 px-3 py-2 font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:z-10 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white focus:outline-none disabled:pointer-events-auto disabled:opacity-50">
                        Edit
                    </button>
                    <button type="button"
                        class="-ms-px rounded-e-sm border border-gray-200 px-3 py-2 font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:z-10 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white focus:outline-none disabled:pointer-events-auto disabled:opacity-50">
                        Delete
                    </button>
                </div>
                <button type="button" class="btn btn-primary">Click me!</button>
            </div>
    </main>
@endsection
