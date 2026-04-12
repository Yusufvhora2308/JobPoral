<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Resume</title>

<style>
body {
    font-family: DejaVu Sans;
    font-size: 13px;
    color: #333;
    line-height: 1.6;
}

.header {
    text-align: center;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.name {
    font-size: 24px;
    font-weight: bold;
}

.contact {
    font-size: 12px;
}

.section {
    margin-bottom: 20px;
}

.section-title {
    font-size: 16px;
    font-weight: bold;
    border-bottom: 1px solid #000;
    margin-bottom: 10px;
    padding-bottom: 3px;
}

ul {
    margin: 0;
    padding-left: 15px;
}

li {
    margin-bottom: 5px;
}

.exp-box {
    margin-bottom: 10px;
}

.exp-title {
    font-weight: bold;
}

.date {
    float: right;
    font-size: 12px;
}
.clear {
    clear: both;
}
</style>

</head>

<body>

<!-- HEADER -->
<div class="header">
    <table width="100%">
        <tr>
            <!-- LEFT SIDE -->
            <td>
                <div class="name">{{ $user->name }}</div>

                <div class="contact">
                    {{ $user->email }} | {{ $user->phone ?? 'N/A' }} <br>

                    @if(!empty($user->location))
                         {{ $user->location }} <br>
                    @endif

                    @if(!empty($user->linkedin))
                         LinkedIn: {{ $user->linkedin }} <br>
                    @endif

                    @if(!empty($user->github))
                         GitHub: {{ $user->github }}
                    @endif
                </div>
            </td>

            <!-- RIGHT SIDE PHOTO -->
            <td align="right">
                @if(!empty($user->profile_photo))
                    <img src="{{ public_path('storage/'.$user->profile_photo) }}" 
                         style="width:80px; height:80px; border-radius:50%;">
                @endif
            </td>
        </tr>
    </table>
</div>

<!-- JOB PREFERENCES (REQUIRED) -->
@if(
    ($jobtitles ?? collect())->isNotEmpty() ||
    ($jobtypes ?? collect())->isNotEmpty() ||
    ($remotes ?? collect())->isNotEmpty() ||
    ($workschedules ?? collect())->isNotEmpty()
)

<div class="section">
    <div class="section-title">Job Preferences</div>

    <!-- Job Titles -->
    @if(($jobtitles ?? collect())->isNotEmpty())
        <p><strong>Roles:</strong>
            @foreach($jobtitles as $title)
                {{ $title->title }}@if(!$loop->last), @endif
            @endforeach
        </p>
    @endif

    <!-- Job Types -->
    @if(($jobtypes ?? collect())->isNotEmpty())
        <p><strong>Job Types:</strong>
            @foreach($jobtypes as $type)
                {{ $type->type }}@if(!$loop->last), @endif
            @endforeach
        </p>
    @endif

    <!-- Remote -->
    @if(($remotes ?? collect())->isNotEmpty())
        <p><strong>Work Mode:</strong>
            @foreach($remotes as $remote)
                {{ $remote->type }}@if(!$loop->last), @endif
            @endforeach
        </p>
    @endif

    <!-- Work Schedule -->
    @if(($workschedules ?? collect())->isNotEmpty())
        <p><strong>Schedule:</strong>
            @foreach($workschedules as $schedule)
                {{ $schedule->schedule }}@if(!$loop->last), @endif
            @endforeach
        </p>
    @endif

    <!-- Salary -->
    @if(($pays ?? collect())->isNotEmpty())
        <p><strong>Expected Salary:</strong>
            @foreach($pays as $pay)
                ₹{{ $pay->amount }} / {{ $pay->period }}@if(!$loop->last), @endif
            @endforeach
        </p>
    @endif

</div>
@endif

<!-- EDUCATION -->
@if(($educations ?? collect())->isNotEmpty())
<div class="section">
    <div class="section-title">Education</div>
    <ul>
        @foreach($educations as $edu)
        <li>
            <strong>{{ $edu->degree }}</strong> - {{ $edu->college }}
            ({{ $edu->year }})
        </li>
        @endforeach
    </ul>
</div>
@endif

<!-- SKILLS -->
@if(($skills ?? collect())->isNotEmpty())
<div class="section">
    <div class="section-title">Skills</div>
    <ul>
        @foreach($skills as $skill)
        <li>{{ $skill->skill }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- EXPERIENCE -->
@if(($experiences ?? collect())->isNotEmpty())
<div class="section">
    <div class="section-title">Experience</div>

    @foreach($experiences as $exp)
    <div class="exp-box">
        <div class="exp-title">
            {{ $exp->job_title }} - {{ $exp->company_name }}
            <span class="date">
                {{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}
            </span>
        </div>
        <div class="clear"></div>
        <div>{{ $exp->description }}</div>
    </div>
    @endforeach

</div>
@endif

<!-- LANGUAGES -->
@if(($languages ?? collect())->isNotEmpty())
<div class="section">
    <div class="section-title">Languages</div>
    <ul>
        @foreach($languages as $lang)
        <li>{{ $lang->language }} ({{ $lang->level }})</li>
        @endforeach
    </ul>
</div>
@endif

<!-- CERTIFICATES -->
@if(($certificates ?? collect())->isNotEmpty())
<div class="section">
    <div class="section-title">Certificates</div>
    <ul>
        @foreach($certificates as $cert)
        <li>{{ $cert->name }} - {{ $cert->organization }} ({{ $cert->year }})</li>
        @endforeach
    </ul>
</div>
@endif

@if(($licenses ?? collect())->isNotEmpty())

<div style="page-break-before: always;"></div>

<div class="section">
    <div class="section-title">Licenses</div>
    <ul>
        @foreach($licenses as $license)
        <li>
            {{ $license->name }} - {{ $license->authority }} ({{ $license->year }})
        </li>
        @endforeach
    </ul>
</div>

@endif

</body>
</html>