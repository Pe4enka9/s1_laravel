<?php

use App\Models\Booking\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public int $step = 1;
    #[Validate]
    public string $phone = '';
    #[Validate]
    public string $date = '';
    #[Validate]
    public ?int $duration = null;
    #[Validate]
    public ?int $peoples = null;

    protected function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:255', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'date' => ['required', 'string', 'date:Y-m-d\TH:i', 'after_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1', 'max:10'],
            'peoples' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    #[On(['update-auth-status', 'open-booking-form'])]
    public function updateUserPhone(): void
    {
        $this->phone = Auth::user()->phone ?? '';
    }

    public function prevStep(): void
    {
        if ($this->step === 1) {
            $this->dispatch('close-booking-form');
            return;
        }

        $this->step--;
    }

    public function nextStep(): void
    {
        switch ($this->step) {
            case 1:
                $this->validateOnly('phone');
                break;
            case 2:
                $this->validateOnly('date');
                $this->validateOnly('duration');
                break;
            case 3:
                $this->validateOnly('peoples');
                $this->save();
                return;
        }

        $this->step++;
    }

    public function save(): void
    {
        $this->validate();

        Booking::create([
            'user_id' => Auth::id() ?? null,
            'phone' => $this->phone,
            'date' => $this->date,
            'duration' => $this->duration,
            'peoples' => $this->peoples,
        ]);

        $this->dispatch('close-booking-form');
        $this->reset();
        $this->step = 1;
    }
};
?>

<div>
    <x-forms.step-form
        event="booking"
        :icon="asset('icons/calendar.svg')"
        title="Бронирование"
        :step-labels="['Контакт', 'Дата и время', 'Люди']"
        end-button-text="Забронировать"
    >
        <div class="flex flex-col gap-4 w-full shrink-0 px-5">
            <x-inputs.input
                label="Номер телефона"
                type="tel"
                name="phone"
                id="booking_phone"
                placeholder="+7 (000) 000-00-00"
            />
        </div>

        <div class="flex flex-col gap-4 w-full shrink-0 px-5">
            <x-inputs.input
                label="Дата и время"
                type="datetime-local"
                name="date"
                id="booking_date"
                :min="now()->format('Y-m-d\TH:i')"
            />

            <x-inputs.input
                label="Продолжительность (в часах)"
                type="number"
                name="duration"
                id="booking_duration"
                placeholder="2"
            />
        </div>

        <div class="flex flex-col gap-4 w-full shrink-0 px-5">
            <x-inputs.input
                label="Количество человек"
                type="number"
                name="peoples"
                id="booking_peoples"
                placeholder="Максимум 5"
            />
        </div>
    </x-forms.step-form>
</div>
