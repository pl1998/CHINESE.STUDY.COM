<x-mail::message>
    # ELENA MANDARIN Website message prompt
    ### Some users have purchased the recorded courses
    ---

    **Course Information:**

    - **Name of the recorded course:** {{ $order->course->name }}
    - **Name of the recorded course ZH:** {{ $order->course->zh_name }}
    - **OrderNo :** {{ $order->order_no }}

    **User information:**
    - **Name:** {{ $order->name }}
    - **Email:** {{ $order->email }}
    - **Phone:** {{ $order->phone }}

    Please contact the user in a timely manner!: {{$order->email}}

    ---
    Contact:
    - [instagram Calendar](#{{ $site['instagram_url'] ?? '' }})
    - [Tiktok Calendar](#{{ $site['tiktok_url'] ?? '' }})
    - [Youtube Calendar](#{{ $site['youtube_url'] ?? '' }})
    Thank you.<br>
    {{ config('app.name') }}
    
</x-mail::message>
