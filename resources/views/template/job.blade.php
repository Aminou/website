<article class="job">
    <h2 class="subtitle">{{ $job->job_title }} @ {{ $job->company }}</h2>
    <h3>{{ $job->start_date->format('M Y') }}-{{$job->end_date->format('M Y')}}</h3>
    <p>
        {{ $job->description }}
    </p>

    <footer>
        {{ $job->url or null }}
    </footer>
</article>