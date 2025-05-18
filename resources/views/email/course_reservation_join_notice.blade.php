<x-mail::message>
    # ELENA MANDARIN 1-on-1 Course Notice

    The course you have reserved will start in 15 minutes. Please get ready to join the meeting in advance!

    ---

    **Your reservation details:**

    - **Date:** {{ date('Y-m-d H:i:s', $courseReservation->start_time) }} ~ {{ date('Y-m-d H:i:s', $courseReservation->end_time) }}
    - **Course:** {{$courseReservation->courseLesson->name}}
    - **Zoom Url:** {{ $courseReservation->zoom_url }}
    ---

    Please join as soon as possible!:

    To manage your reservation, please visit the

    - [Google Calendar](#)
    - [Outlook Calendar](#)
    - [Yahoo Calendar](#)
    - [Apple Calendar](#)

    Thank you.<br>
    {{ config('app.name') }}
</x-mail::message>
