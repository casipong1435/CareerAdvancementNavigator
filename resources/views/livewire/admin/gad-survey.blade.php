<div class="row">
    <div class="col-md-12">
        <div class="form-group d-flex justify-content-between p-2">
            <div>
                <span class="fw-bold">Calendar Year:</span>
                <select wire:model.live="calendar_year" class="p-2">
                    @for ($year = $start_year; $year <= $end_year; $year++)
                    <option {{$year == $today ? 'selected':''}} value="{{$year}}">{{$year}}</option>
                    @endfor
                </select>
            </div>
            <div class="p-2">
                <a wire:navigate href="{{ route('gadquestion') }}" class="text-decoration-none px-1 training-link {{ Route::currentRouteName() == 'gadquestion' ? 'active':'' }}">GAD Assessment</a>
                <a wire:navigate href="{{ route('gadsurvey') }}" class="text-decoration-none px-1 training-link {{ Route::currentRouteName() == 'gadsurvey' || session()->get('gadsurvey') ? 'active':'' }}">Result</a>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group p-2 text-center mb-2">
            <h3>Respondent Analytics {{$calendar_year}}</h3>
        </div>
        <div class="col-md-12 g-0">
            <div class="row g-0">
                <div class="col-md-6 p-2 shadow rounded">
                    <div class="text-center p-2 border-bottom">
                        <div class="h5 fw-bold">Employee Responded</div>
                    </div>
                    <div class="d-flex justify-content-between rounded p-2 fs-4 responded-user-tab {{ $teachingList ? 'active':'' }}" wire:click="clickList('teaching')">
                        <div>Teaching</div>
                        <div>{{ count($teaching_respondents).'/'.$teaching_count }}</div>
                    </div>
                    @if ($teachingList)
                        <div class="p-2" style="background: #d8d8d8">
                            @if (count($teaching_respondents) > 0)
                                @foreach ($teaching_respondents as $respondent)
                                    <div class="d-flex justify-content-between p-2">
                                        <div>{{ ucfirst($respondent->first_name).' '.ucfirst($respondent->last_name) }}</div>
                                        <div>{{ $respondent->position }}</div>
                                    </div>
                                @endforeach
                            @else
                            <div class="text-center p-2">No Teaching Personnel Responded Yet!</div>
                            @endif
                        </div>
                    @endif
                    <div class="d-flex justify-content-between rounded p-2 fs-4 responded-user-tab {{ $non_teachingList ? 'active':'' }}" wire:click="clickList('non_teaching')">
                        <div>Non-Teaching</div>
                        <div>{{ count($non_teaching_respondents).'/'.$non_teaching_count }}</div>
                    </div>
                    @if ($non_teachingList)
                        <div class="p-2" style="background: #d8d8d8">
                            @if (count($non_teaching_respondents) > 0)
                                @foreach ($non_teaching_respondents as $respondent)
                                    <div class="d-flex justify-content-between p-2">
                                        <div>{{ ucfirst($respondent->first_name).' '.ucfirst($respondent->last_name) }}</div>
                                        <div>{{ $respondent->position }}</div>
                                    </div>
                                @endforeach
                            @else
                            <div class="text-center p-2">No Non-Teaching Personnel Responded Yet!</div>
                            @endif
                        </div>
                    @endif
                    <div class="d-flex justify-content-between rounded p-2 fs-4 responded-user-tab {{ $teaching_relatedList ? 'active':'' }}" wire:click="clickList('teaching_related')">
                        <div>Teaching Related</div>
                        <div>{{ count($teaching_related_respondents).'/'.$teaching_related_count }}</div>
                    </div>
                    @if ($teaching_relatedList)
                        <div class="p-2" style="background: #d8d8d8">
                            @if (count($teaching_related_respondents) > 0)
                                @foreach ($teaching_related_respondents as $respondent)
                                    <div class="d-flex justify-content-between p-2">
                                        <div>{{ ucfirst($respondent->first_name).' '.ucfirst($respondent->last_name) }}</div>
                                        <div>{{ $respondent->position }}</div>
                                    </div>
                                @endforeach
                            @else
                            <div class="text-center p-2">No Teaching Related Personnel Responded Yet!</div>
                            @endif
                        </div>
                    @endif
                    <div class="d-flex justify-content-between p-2 fw-bold fs-4">
                        <div>Total</div>
                        @php
                            $total_teaching_related_respondents = count($teaching_respondents) + count($non_teaching_respondents) + count($teaching_related_respondents);
                            $expected_teaching_related_respondents = $teaching_count + $non_teaching_count + $teaching_related_count;
                            $percentage_teaching_related_respondents = ($total_teaching_related_respondents / $expected_teaching_related_respondents) * 100;
                        @endphp
                        <div>
                            <span class="me-2">{{ $total_teaching_related_respondents.'/'.$expected_teaching_related_respondents }}</span>
                            <span class="fw-normal text-secondary">({{ intval($percentage_teaching_related_respondents).'%' }})</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <table class="text-center shadow rounded">
            <thead class="border-bottom" style="background: #ffffff">
                <tr>
                    <th>Top</th>
                    <th>Activity or Topic</th>
                    <th>Respondent</th>
                </tr>
            </thead>
            <tbody style="background: #ffffff">
                @if (count($question_description) > 0)
                @php
                    $i = 1;
                @endphp
                    @foreach ($question_description as $question)
                        <tr class="{{ $i == 1 || $i == 2 || $i == 3 ? 'fw-bold':''}}">
                            <td class="p-2">{{ $i++ }}</td>
                            <td class="text-start">{{ $question->description }}</td>
                            <td>{{ $occurrences[$question->id] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No Result Yet!</td>
                        
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>