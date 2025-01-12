<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $resume->title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4F46E5;
            padding-bottom: 20px;
        }
        h1 {
            color: #4F46E5;
            margin: 0;
            font-size: 24px;
        }
        .contact-info {
            font-size: 14px;
            color: #666;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            color: #4F46E5;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .education-item, .experience-item {
            margin-bottom: 15px;
            padding-left: 15px;
            border-left: 3px solid #4F46E5;
        }
        .institution, .company {
            font-weight: bold;
            font-size: 16px;
        }
        .degree, .position {
            font-size: 15px;
            color: #4F46E5;
        }
        .dates {
            font-size: 14px;
            color: #666;
        }
        .description {
            font-size: 14px;
            margin-top: 5px;
        }
        .skills-list, .languages-list, .certifications-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .skill-item, .language-item, .certification-item {
            background-color: #EEF2FF;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            color: #4F46E5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $resume->first_name }} {{ $resume->last_name }}</h1>
        <div class="contact-info">
            {{ $resume->email }}
            @if($resume->phone) | {{ $resume->phone }} @endif
            @if($resume->address) | {{ $resume->address }} @endif
        </div>
    </div>

    @if($resume->summary)
    <div class="section">
        <h2 class="section-title">Résumé</h2>
        <p>{{ $resume->summary }}</p>
    </div>
    @endif

    @if($resume->education && count($resume->education) > 0)
    <div class="section">
        <h2 class="section-title">Formation</h2>
        @foreach($resume->education as $education)
        <div class="education-item">
            <div class="institution">{{ $education['institution'] }}</div>
            <div class="degree">{{ $education['degree'] }} en {{ $education['field'] }}</div>
            <div class="dates">
                {{ \Carbon\Carbon::parse($education['start_date'])->format('M Y') }} - 
                {{ isset($education['end_date']) ? \Carbon\Carbon::parse($education['end_date'])->format('M Y') : 'Présent' }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($resume->experience && count($resume->experience) > 0)
    <div class="section">
        <h2 class="section-title">Expérience professionnelle</h2>
        @foreach($resume->experience as $experience)
        <div class="experience-item">
            <div class="company">{{ $experience['company'] }}</div>
            <div class="position">{{ $experience['position'] }}</div>
            <div class="dates">
                {{ \Carbon\Carbon::parse($experience['start_date'])->format('M Y') }} - 
                {{ isset($experience['end_date']) ? \Carbon\Carbon::parse($experience['end_date'])->format('M Y') : 'Présent' }}
            </div>
            <div class="description">{{ $experience['description'] }}</div>
        </div>
        @endforeach
    </div>
    @endif

    @if($resume->skills)
    <div class="section">
        <h2 class="section-title">Compétences</h2>
        <ul class="skills-list">
            @foreach($resume->skills as $skill)
            <li class="skill-item">{{ $skill }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($resume->languages && count($resume->languages) > 0)
    <div class="section">
        <h2 class="section-title">Langues</h2>
        <ul class="languages-list">
            @foreach($resume->languages as $language)
            <li class="language-item">{{ $language }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($resume->certifications)
    <div class="section">
        <h2 class="section-title">Certifications</h2>
        <ul class="certifications-list">
            @foreach($resume->certifications as $certification)
            <li class="certification-item">{{ $certification }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>
