import { Head, /*usePage*/ } from '@inertiajs/react';

import AppearanceTabs from '@/components/appearance-tabs';
import HeadingSmall from '@/components/heading-small';
import { /*SharedData*/ type BreadcrumbItem } from '@/types';

import SettingsLayout from '@/layouts/settings/layout';

import AdminLayout from '@/pages/admin/layer/app-layout';
//import PustakawanLayout from '@/pages/librarian/layer/user-layout';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: '/settings/appearance',
    },
];

export default function Appearance() {
    //const { auth } = usePage<SharedData>().props;
/*    const Layout =
        auth.user.role === 'ADMIN'
            ? AdminLayout
            : auth.user.role === 'PUSTAKAWAN'
                ? PustakawanLayout
                : UserLayout;*/

    return (
        <AdminLayout breadcrumbs={breadcrumbs}>
            <Head title="Appearance settings" />

            <SettingsLayout>
                <div className="space-y-6">
                    <HeadingSmall title="Appearance settings" description="Update your account's appearance settings" />
                    <AppearanceTabs />
                </div>
            </SettingsLayout>
        </AdminLayout>
    );
}
