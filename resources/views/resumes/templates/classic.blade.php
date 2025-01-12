<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $resume->title }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            color: #000;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        h2 {
            font-size: 18px;
            margin-top: 20px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .contact-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .section {
            margin-bottom: 25px;
        }
        .experience-item, .education-item {
            margin-bottom: 15px;
        }
        .experience-item h3, .education-item h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .date {
            font-style: italic;
            font-size: 14px;
        }
        .skills-list {
            columns: 2;
            -webkit-columns: 2;
            -moz-columns: 2;
            margin-top: 10px;
        }
        .languages-list, .certifications-list {
            list-style-type: disc;
            padding-left: 20px;
        }
        .languages-list li, .certifications-list li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $resume->first_name }} {{ $resume->last_name }}</h1>
        <div class="contact-info">
            <p>{{ $resume->email }} | {{ $resume->phone }}</p>
            @if($resume->address)
                <p>{{ $resume->address }}</p>
            @endif
        </div>
    </div>

    @if($resume->summary)
        <div class="section">
            <h2>Résumé professionnel</h2>
            <p>{{ $resume->summary }}</p>
        </div>
    @endif

    @if($resume->experience && count($resume->experience) > 0)
        <div class="section">
            <h2>Expérience professionnelle</h2>
            @foreach($resume->experience as $experience)
                <div class="experience-item">
                    <h3>{{ $experience['position'] }}</h3>
                    <p>{{ $experience['company'] }}</p>
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
                    <h3>{{ $education['degree'] }} en {{ $education['field'] }}</h3>
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
                    <p>• {{ $skill }}</p>
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
