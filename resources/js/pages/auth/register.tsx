import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle, Lock, Mail, RefreshCcwDotIcon, User } from 'lucide-react';
import { FormEventHandler } from 'react';

import AppLogoIcon from '@/components/app-logo-icon';
import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

type RegisterForm = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm<Required<RegisterForm>>({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('register'), {
            onFinish: () => {
                reset('password', 'password_confirmation');
            },
        });
    };

    return (
        <div
            className="relative min-h-screen w-full bg-cover bg-center py-32 dark:text-white"
            style={{
                backgroundColor: '#ffffff',
                backgroundImage:
                    "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='105' viewBox='0 0 80 105'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='death-star' fill='%23004380' fill-opacity='0.51'%3E%3Cpath d='M20 10a5 5 0 0 1 10 0v50a5 5 0 0 1-10 0V10zm15 35a5 5 0 0 1 10 0v50a5 5 0 0 1-10 0V45zM20 75a5 5 0 0 1 10 0v20a5 5 0 0 1-10 0V75zm30-65a5 5 0 0 1 10 0v50a5 5 0 0 1-10 0V10zm0 65a5 5 0 0 1 10 0v20a5 5 0 0 1-10 0V75zM35 10a5 5 0 0 1 10 0v20a5 5 0 0 1-10 0V10zM5 45a5 5 0 0 1 10 0v50a5 5 0 0 1-10 0V45zm0-35a5 5 0 0 1 10 0v20a5 5 0 0 1-10 0V10zm60 35a5 5 0 0 1 10 0v50a5 5 0 0 1-10 0V45zm0-35a5 5 0 0 1 10 0v20a5 5 0 0 1-10 0V10z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
            }}
        >
            <div className="absolute inset-0 z-0 bg-gradient-to-b from-black/70 via-black/40 to-black/70" />

            <div className="relative z-10 flex min-h-screen items-center justify-center px-4">
                <div className="w-full max-w-md space-y-3 rounded-2xl bg-white p-8 shadow-lg dark:bg-black">
                    <Head title="Daftar" />

                    {/* Logo */}
                    <div className="mb-2 flex justify-center">
                        <AppLogoIcon className="h-40 w-40 animate-pulse" />
                    </div>

                    <h1 className="text-center text-2xl font-bold">Buat akun baru</h1>
                    <p className="mb-5 text-center text-sm">Masukkan detail Anda untuk membuat akun baru</p>

                    <form className="flex flex-col gap-4" onSubmit={submit}>
                        {/* Name */}
                        <div>
                            <Label htmlFor="name" className="mb-1 block font-semibold">
                                Nama lengkap
                            </Label>
                            <div className="focus-within:border-primary-500 focus-within:ring-primary-500 flex items-center rounded-lg border bg-white shadow-sm focus-within:ring-1 dark:border-2 dark:border-white dark:bg-black">
                                <div className="text-primary-500 px-3">
                                    <User size={18} />
                                </div>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="name"
                                    placeholder="Nama lengkap"
                                    className="rounded-l-none border-none focus:ring-0"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    disabled={processing}
                                />
                            </div>
                            <InputError message={errors.name} />
                        </div>

                        {/* Email */}
                        <div>
                            <Label htmlFor="email" className="mb-1 block font-semibold">
                                Email address
                            </Label>
                            <div className="focus-within:border-primary-500 focus-within:ring-primary-500 flex items-center rounded-lg border bg-white shadow-sm focus-within:ring-1 dark:border-2 dark:border-white dark:bg-black">
                                <div className="text-primary-500 px-3">
                                    <Mail size={18} />
                                </div>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    tabIndex={2}
                                    autoComplete="email"
                                    placeholder="email@example.com"
                                    className="rounded-l-none border-none focus:ring-0"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    disabled={processing}
                                />
                            </div>
                            <InputError message={errors.email} />
                        </div>

                        {/* Password */}
                        <div>
                            <Label htmlFor="password" className="mb-1 block font-semibold">
                                Password
                            </Label>
                            <div className="focus-within:border-primary-500 focus-within:ring-primary-500 flex items-center rounded-lg border bg-white shadow-sm focus-within:ring-1 dark:border-2 dark:border-white dark:bg-black">
                                <div className="text-primary-500 px-3">
                                    <Lock size={18} />
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    tabIndex={3}
                                    autoComplete="new-password"
                                    placeholder="Password"
                                    className="rounded-l-none border-none focus:ring-0"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    disabled={processing}
                                />
                            </div>
                            <InputError message={errors.password} />
                        </div>

                        {/* Password confirmation */}
                        <div>
                            <Label htmlFor="password_confirmation" className="mb-1 block font-semibold">
                                Konfirmasi password
                            </Label>
                            <div className="focus-within:border-primary-500 focus-within:ring-primary-500 flex items-center rounded-lg border bg-white shadow-sm focus-within:ring-1 dark:border-2 dark:border-white dark:bg-black">
                                <div className="text-primary-500 px-3">
                                    <RefreshCcwDotIcon size={18} />
                                </div>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    required
                                    tabIndex={4}
                                    autoComplete="new-password"
                                    placeholder="Konfirmasi password"
                                    className="rounded-l-none border-none focus:ring-0"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    disabled={processing}
                                />
                            </div>
                            <InputError message={errors.password_confirmation} />
                        </div>

                        {/* Submit */}
                        <Button type="submit" className="w-full dark:text-white" tabIndex={5} disabled={processing}>
                            {processing && <LoaderCircle className="mr-2 inline-block h-5 w-5 animate-spin" />}
                            Buat akun
                        </Button>
                    </form>

                    <div className="mt-4 text-center text-xs">
                        Sudah punya akun?{' '}
                        <TextLink href={route('login')} tabIndex={6} className="text-primary-500">
                            Log in
                        </TextLink>
                    </div>
                </div>
            </div>
        </div>
    );
}
