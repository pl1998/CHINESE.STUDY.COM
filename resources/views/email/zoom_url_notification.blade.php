<x-mail::message>
# ELENA MANDARIN 1-on-1 Hello, please accept your online course notice

🎉 **The following is the online live streaming address!**

---

**Your reservation details:**

- **Date:** {{ $courseReservation->start_time }} ~ {{ $courseReservation->end_time }}
- **Course:** 1V1 LESSON
- **Teacher:** 1V1 LESSON
- **Zoom URL:** {{ $courseReservation->zoom_url }}
---
You can add this course to your calendar:
- [Google Calendar](#)
- [Outlook Calendar](#)
- [Yahoo Calendar](#)
- [Apple Calendar](#)
To manage your reservation, please visit the
Thank you.<br>
{{ config('app.name') }}
</x-mail::message>