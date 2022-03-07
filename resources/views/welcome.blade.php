<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <livewire:styles />
    <livewire:scripts />
</head>

<body class="flex justify-center">
    <div class="w-10/12 my-10 flex">
        <div class="w-5/12 rounded border p-2">
            {{-- to include any livewire component you use the following --}}
{{--            @livewire('counter')--}}
            <livewire:tickets />
        </div>
        <div class="w-7/12 mx-2 rounded border p-2">
{{--            @livewire('comments')--}}
            <livewire:comments />
            {{--whatever is passed, it can be caught in the mount()--}}
{{--            <livewire:comments comments="I am props coming from welcome page"/>--}}
{{--            <livewire:comments :comments="$comments"/>--}}
        </div>
    </div>

</body>

</html>
