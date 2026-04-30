<?php

use App\Models\Booking\Booking;
use App\Models\Booking\Enums\BookingStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public User $user;
    public ?BookingStatusEnum $filter = null;

    public function mount(): void
    {
        $this->user = Auth::user()->with('bookings')->first();
    }

    public function setFilter(?BookingStatusEnum $filter = null): void
    {
        $this->filter = $filter;
    }

    #[Computed]
    public function bookings(): Collection
    {
        return $this->user->bookings()
            ->when($this->filter, function (Builder $query) {
                $query->where('status', $this->filter);
            })
            ->latest()
            ->get();
    }

    public function edit(): void
    {
        $this->dispatch('open-users-edit-form');
    }

    #[On('close-users-edit-form')]
    public function updateUserData(): void
    {
        $this->user = Auth::user()->with('bookings')->first();
    }
};
?>

<div>
    <livewire:users.edit/>

    <div class="grid grid-cols-4 gap-10">
        <div class="col-span-1">
            <div class="bg-main border border-my-border rounded-lg flex flex-col overflow-hidden">
                <div class="flex flex-col items-center gap-2.5 bg-linear-to-r from-secondary to-primary p-6">
                    <div class="w-24 h-24 bg-white/20 rounded-full p-5 border-2 border-white/40">
                        <img src="{{ asset('icons/profile.svg') }}" alt="">
                    </div>

                    <div class="text-white text-2xl font-bold">{{ $this->user->full_name }}</div>
                </div>

                <div class="flex flex-col gap-5 p-6">
                    <x-profile.user-data-item
                        :icon="asset('icons/phone.svg')"
                        label="Телефон"
                        :value="$this->user->phone"
                    />

                    <x-profile.user-data-item
                        :icon="asset('icons/profile.svg')"
                        label="Имя"
                        :value="$this->user->first_name"
                    />

                    <x-profile.user-data-item
                        :icon="asset('icons/profile.svg')"
                        label="Фамилия"
                        :value="$this->user->last_name"
                    />

                    <x-buttons.btn class="outline" click="edit">
                        Редактировать профиль
                    </x-buttons.btn>
                </div>
            </div>
        </div>

        <div class="col-span-3 flex flex-col gap-3">
            <div class="text-white text-2xl font-semibold">Мои бронирования</div>

            <div class="flex gap-3">
                <x-buttons.profile :is-active="$this->filter === null">Все</x-buttons.profile>

                @foreach(BookingStatusEnum::cases() as $status)
                    <x-buttons.profile :filter="$status" :is-active="$this->filter === $status">
                        {{ $status->label() }}
                    </x-buttons.profile>
                @endforeach
            </div>

            <div class="border border-my-border rounded-xl overflow-hidden">
                <table class="w-full">
                    <thead
                        class="bg-[#262626] border-b border-my-border text-text-secondary text-sm uppercase text-left"
                    >
                    <tr>
                        <th class="p-3">Телефон</th>
                        <th class="p-3">Дата и время</th>
                        <th class="p-3">Часы</th>
                        <th class="p-3">Человек</th>
                        <th class="p-3">Дата заявки</th>
                        <th class="p-3">Статус</th>
                    </tr>
                    </thead>

                    <tbody class="bg-main text-white">
                    @php /** @var Booking $booking */ @endphp

                    @forelse($this->bookings as $booking)
                        <tr class="border-b border-[#75757533] last:border-b-0">
                            <td class="p-3 font-medium">{{ $booking->phone }}</td>

                            <td class="p-3">
                                <div>{{ $booking->date_formatted }}</div>
                                <div class="text-text-secondary text-sm">{{ $booking->time_formatted }}</div>
                            </td>

                            <td class="p-3">{{ $booking->duration }} ч</td>
                            <td class="p-3">{{ $booking->peoples }}</td>
                            <td class="p-3">{{ $booking->created_at_date_formatted }}</td>

                            <td class="p-3">
                                <x-profile.status :status="$booking->status->value">
                                    {{ $booking->status->label() }}
                                </x-profile.status>
                            </td>
                        </tr>
                    @empty
                        <div class="text-white">Нет бронирований</div>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
