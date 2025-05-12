<x-mail::message>
# ELENA MANDARIN 1-on-1 Course Reservation Successful

🎉 **Congratulations, your reservation is confirmed!**

---

**Your reservation details:**

- **Date:** {{ $courseReservation->start_time }} ~ {{ $courseReservation->end_time }}
- **Course:** 1V1 LESSON
- **Teacher:** 1V1 LESSON
- **Recurring:** {{ $courseReservation->repeat }}
- **Payment:** {{ $courseReservation->pay_price }} $
- **Name:** {{ $courseReservation->fisrt_name }} - {{ $courseReservation->last_name }}
- **Email:** {{ $courseReservation->email }}
- **OrderNo:** {{ $courseReservation->order_no }}
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