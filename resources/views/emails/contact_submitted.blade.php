<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Website Inquiry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #1e40af, #2563eb);
            color: #ffffff;
            padding: 32px 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 32px 24px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 8px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
        }
        .info-table td {
            padding: 10px 0;
            vertical-align: top;
        }
        .info-table td.label {
            font-weight: 600;
            color: #475569;
            width: 35%;
        }
        .info-table td.value {
            color: #0f172a;
        }
        .message-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 16px 20px;
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: #334155;
            white-space: pre-line;
        }
        .footer {
            background-color: #f1f5f9;
            padding: 20px 24px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 0 0 8px 0;
        }
        .footer p:last-child {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>New Website Inquiry</h1>
            <p>A client has submitted a query via the contact form</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="section-title">Client Details</div>
            <table class="info-table">
                <tr>
                    <td class="label">Name:</td>
                    <td class="value">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td class="value"><a href="mailto:{{ $contact->email }}" style="color: #2563eb; text-decoration: none;">{{ $contact->email }}</a></td>
                </tr>
                <tr>
                    <td class="label">Phone:</td>
                    <td class="value">{{ $contact->phone ?? 'N/A' }}</td>
                </tr>
                @if($contact->businessname)
                <tr>
                    <td class="label">Business Name:</td>
                    <td class="value">{{ $contact->businessname }}</td>
                </tr>
                @endif
                @if($contact->services)
                <tr>
                    <td class="label">Services Requested:</td>
                    <td class="value">{{ $contact->services }}</td>
                </tr>
                @endif
                @if($contact->website)
                <tr>
                    <td class="label">Website:</td>
                    <td class="value"><a href="{{ $contact->website }}" target="_blank" style="color: #2563eb; text-decoration: none;">{{ $contact->website }}</a></td>
                </tr>
                @endif
            </table>

            <div class="section-title">Message / Query</div>
            <div class="message-box">
                {{ $contact->message }}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>This message was sent automatically from the contact form submission on <strong>DG Studio 24</strong>.</p>
            <p>&copy; {{ date('Y') }} DG Studio 24. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
