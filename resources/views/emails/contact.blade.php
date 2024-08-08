<div style="font-family: Arial, sans-serif; color: #333; line-height: 1.5;">
    <p style="margin: 0 0 10px 0;">
        <strong>Name:</strong> {{ $details['firstName'].' '.$details['lastName'] }}
    </p>
    <p style="margin: 0 0 10px 0;">
        <strong>Company:</strong> {{ $details['company'] ?? '-' }}
    </p>
    <p style="margin: 0 0 10px 0;">
        <strong>Email:</strong> {{ $details['userEmail'] }}
    </p>
    <p style="margin: 0 0 10px 0;"><strong>Message:</strong></p>
    <div style="background-color: #003366; color: #ffffff; padding: 15px; border-radius: 5px;">
        {{ $details['message'] }}
    </div>
</div>
