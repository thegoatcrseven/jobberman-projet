<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $resume->title }}</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
            padding: 30px;
            background-color: #fff;
        }
        .header {
            margin-bottom: 40px;
        }
        h1 {
            font-size: 32px;
            font-weight: 300;
            margin: 0;
            color: #1a202c;
        }
        h2 {
            font-size: 20px;
            font-weight: 400;
            color: #4a5568;
            margin-top: 30px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .contact-info {
            margin-top: 10px;
            color: #4a5568;
            font-size: 14px;
        }
        .section {
            margin-bottom: 30px;
        }
        .experience-item, .education-item {
            margin-bottom: 20px;
        }
        .experience-item h3, .education-item h3 {
            font-size: 16px;
            font-weight: 500;
            margin: 0;
            color: #2d3748;
        }
        .date {
            color: #718096;
            font-size: 14px;
            margin: 5px 0;
        }
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        .skill-item {
            font-size: 14px;
            color: #4a5568;
        }
        .languages-list, .certifications-list {
            list-style-type: none;
            padding: 0;
        }
        .languages-list li, .certifications-list li {
            margin-bottom: 8px;
            font-size: 14px;
        }
        p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $resume->first_name }} {{ $resume->last_name }}</h1>
        <div class="contact-info">
            {{ $resume->email }} @if($resume->phone)• {{ $resume->phone }}@endif
            @if($resume->address)
                <br>{{ $resume->address }}
            @endif
        </div>
    </div>

    @if($resume->summary)
        <div class="section">
            <h2>À propos</h2>
            <p>{{ $resume->summary }}</p>
        </div>
    @endif

    @if($resume->experience && count($resume->experience) > 0)
        <div class="section">
            <h2>Expérience</h2>
            @foreach($resume->experience as $experience)
                <div class="experience-item">
                    <h3>{{ $experience['position'] }} • {{ $experience['company'] }}</h3>
                    <p class="date">
                        {{ \Carbon\Carbon::parse($experience['start_date'])->format('M Y') }} - 
                        {{ isset($experience['end_date']) ? \Carbon\Carbon::parse($experience['end_date'])->format('M Y') : 'Présent' }}
                    </p>
                    <p>{{ $experience['description'] }}</p>
                </div>
            @endforeach
        </div>
    @endif

    @if($resume->education && count($resume->education) > 0)
        <div class="section">
            <h2>Formation</h2>
            @foreach($resume->education as $education)
                <div class="education-item">
                    <h3>{{ $education['degree'] }} • {{ $education['field'] }}</h3>
                    <p>{{ $education['institution'] }}</p>
                    <p class="date">
                        {{ \Carbon\Carbon::parse($education['start_date'])->format('M Y') }} - 
                        {{ isset($education['end_date']) ? \Carbon\Carbon::parse($education['end_date'])->format('M Y') : 'Présent' }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif

    @if($resume->skills && count($resume->skills) > 0)
        <div class="section">
            <h2>Compétences</h2>
            <div class="skills-list">
                @foreach($resume->skills as $skill)
                    <span class="skill-item">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
    @endif

    @if($resume->languages && count($resume->languages) > 0)
        <div class="section">
            <h2>Langues</h2>
            <ul class="languages-list">
                @foreach($resume->languages as $language)
                    <li>{{ $language }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($resume->certifications && count($resume->certifications) > 0)
        <div class="section">
            <h2>Certifications</h2>
            <ul class="certifications-list">
                @foreach($resume->certifications as $certification)
                    <li>{{ $certification }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
