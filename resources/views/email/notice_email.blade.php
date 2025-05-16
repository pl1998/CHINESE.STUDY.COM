<x-mail::message>
# ELENA MANDARIN Website message prompt

---
**Message content:**

- **Name:** {{ $contactRecord->name }}
- **Email:** {{ $contactRecord->email }}
- **Message:** {{ $contactRecord->message }}
---
Contact:
- [instagram Calendar](#{{ $site['instagram_url'] ?? '' }})
- [Tiktok Calendar](#{{ $site['tiktok_url'] ?? '' }}) 
- [Youtube Calendar](#{{ $site['youtube_url'] ?? '' }})
Thank you.<br>
{{ config('app.name') }}
</x-mail::message>