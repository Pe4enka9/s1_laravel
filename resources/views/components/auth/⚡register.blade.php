<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public int $step = 1;
    #[Validate]
    public string $phone = '';
    #[Validate]
    public string $first_name = '';
    #[Validate]
    public string $last_name = '';
    #[Validate]
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:255', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', Rule::unique(User::class, 'phone')],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
        ];
    }

    public function updatedPasswordConfirmation(): void
    {
        if ($this->password === $this->password_confirmation) {
            $this->resetErrorBag('password');
        } else {
            $this->validateOnly('password');
        }
    }

    public function prevStep(): void
    {
        if ($this->step === 1) {
            $this->dispatch('close-register-form');
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
                $this->validateOnly('first_name');
                $this->validateOnly('last_name');
                break;
            case 3:
                $this->save();
                return;
        }

        $this->step++;
    }

    public function save(): void
    {
        $this->validate();

        $user = User::create([
            'phone' => $this->phone,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user, true);

        $this->dispatch('close-register-form');
        $this->dispatch('update-auth-status');
        $this->reset();
        $this->step = 1;
    }
};
?>

<div>
    <x-forms.step-form
        event="register"
        :icon="asset('icons/profile.svg')"
        title="Создание аккаунта"
        :step-labels="['Контакт', 'Личные данные', 'Пароль']"
        end-button-text="Зарегистрироваться"
    >
        <div class="flex flex-col gap-4 w-full shrink-0 px-5">
            <x-inputs.input
                label="Номер телефона"
                type="tel"
                name="phone"
                id="register_phone"
                placeholder="+7 (000) 000-00-00"
            />
        </div>

        <div class="flex flex-col gap-4 w-full shrink-0 px-5">
            <x-inputs.input
                label="Имя"
                type="text"
                name="first_name"
                id="register_first_name"
                placeholder="Введите ваше имя"
            />

            <x-inputs.input
                label="Фамилия"
                type="text"
                name="last_name"
                id="register_last_name"
                placeholder="Введите вашу фамилию"
            />
        </div>

        <div class="flex flex-col gap-4 w-full shrink-0 px-5">
            <x-inputs.input
                label="Пароль"
                type="password"
                name="password"
                id="register_password"
                placeholder="Введите пароль"
            />

            <x-inputs.input
                label="Повтор пароля"
                type="password"
                name="password_confirmation"
                id="register_password_confirmation"
                placeholder="Повторите пароль"
            />
        </div>
    </x-forms.step-form>
</div>
