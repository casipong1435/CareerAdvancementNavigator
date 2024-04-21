<div>
    <div class="py-2 d-flex justify-content-between">
        <div class="add-btn">
            <span class="me-2">From: </span>
            <input type="date" wire:model.change="from" class="mx-1">
            <span class="me-2">To: </span>
            <input type="date" wire:model.change="to" class="mx-1">
            @if (session()->has('found'))
                @if ($from != null && $to != null)
                    <a target="_blank" href="{{ route('printGADReport', ['from' => $from, 'to' => $to]) }}" class=" text-decoration-none p-2 rounded" style="color: #5461D4; top: 8px; right:17px"><i class="bi bi-file-earmark-arrow-down-fill fs-3"></i></a>
                @endif
            @endif
        </div>
        <span class="filter d-flex flex-row d-inline-block">
            <div class="mx-2 d-flex justify-content-center align-items-center">
                <span class="filter">Filter: </span>
                <select class="mx-1" wire:model.live="sortBy" name="sort">
                    <option selected disabled>Sort</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <select class="mx-1" wire:model.live="orderBy" name="orderBy">
                    <option selected disabled>Order By</option>
                    <option value="start_of_conduct">Date Started</option>
                    <option value="end_of_conduct">Date Ended</option>
                    <option value="training_title">Title</option>
                    <option value="number_of_hours">Hours</option>
                </select>
            </div>
            <div class="search position-relative mx-2">
                <input type="text" wire:model.live="search_input" placeholder="Search...">
                <span class="position-absolute search-icon"><i class="bi bi-search"></i></span>
            </div>
        </span>
    </div>
    <div class="table-holder mt-2">
        <table cellpadding="2" style="font-size: 13px">
            <thead>
                <tr>
                    <th style="border: 1px solid black">GAD Activity</th>
                    <th style="border: 1px solid black">Date of Conduct</th>
                    <th style="border: 1px solid black">Number of Hours</th>
                    <th colspan="3" style="border: 1px solid black">No. of Participants</th>
                    <th style="border: 1px solid black">Budget</th>
                    <th style="border: 1px solid black">Source of Budget</th>
                    <th style="border: 1px solid black">Responsible Unit</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black"></th>
                    <th style="border: 1px solid black"></th>
                    <th style="border: 1px solid black"></th>
                    <th style="border: 1px solid black">Male</th>
                    <th style="border: 1px solid black">Female</th>
                    <th style="border: 1px solid black">Total</th>
                    <th style="border: 1px solid black"></th>
                    <th style="border: 1px solid black"></th>
                    <th style="border: 1px solid black"></th>
                </tr>
            </thead>
            <tbody style="background: #e6e6e6">
                <?php $i = 1; ?>
                @if (count($official_trainings) > 0)
                    @php
                        $total_budget = 0;
                    @endphp
                    @foreach ($official_trainings as $training)
                        @php
                            $total_budget += $training->budget;
                        @endphp

                        <tr>
                            <td style="border: 1px solid black">{{ $training->training_title }}</td>
                            <td style="border: 1px solid black">{{ $training->start_of_conduct.' - '.$training->end_of_conduct }}</td>
                            <td style="border: 1px solid black">{{ $training->number_of_hours }} hours</td>
                            <td style="border: 1px solid black">{{ $training->female_count }}</td>
                            <td style="border: 1px solid black">{{ $training->male_count }}</td>
                            <td style="border: 1px solid black">{{ $training->attended_trainings_count }}</td>
                            <td style="border: 1px solid black">{{ $training->budget }}</td>
                            <td style="border: 1px solid black">GAD</td>
                            <td style="border: 1px solid black">{{ $training->responsible_unit }}</td>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold">
                        <td colspan="6" style="text-align: left; border: 1px solid black">Total Budget Incurred for CY {{ $year }}</td>
                        <td style="border: 1px solid black">{{ $total_budget }}</td>
                        <td colspan="2" style="border: 1px solid black"></td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11" style="border: 1px solid black">No Trainings Found!</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <span class="fs-5 mt-1">Total: {{ count($official_trainings) }} </span>
    </div>
</div>
