<x-mail::message>
# ELENA MANDARIN 1-on-1 Hello, please accept your online course notice

🎉 **The following is the online live streaming address!**

---

**Your reservation details:**

- **Date:** {{ date('Y-m-d H:i:s', strtotime($courseReservation->start_time)) }} ~ {{ date('Y-m-d H:i:s', strtotime($courseReservation->end_time)) }}
- **Course:** 1V1 LESSON
- **Teacher:** 1V1 LESSON
- **Zoom URL:** {{ $courseReservation->zoom_url }}
---
You can add this course to your calendar:
- [instagram Calendar](#{{ $site['instagram_url'] ?? '' }})
- [Tiktok Calendar](#{{ $site['tiktok_url'] ?? '' }})
- [Youtube Calendar](#{{ $site['youtube_url'] ?? '' }})
To manage your reservation, please visit the
Thank you.<br>
{{ config('app.name') }}
</x-mail::message>