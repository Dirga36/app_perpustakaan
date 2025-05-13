import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { UserInfo } from '@/components/user-info';
import { useMobileNavigation } from '@/hooks/use-mobile-navigation';
import { type User } from '@/types';

import { router } from '@inertiajs/react';
import { Link, usePage } from '@inertiajs/react';
import { SharedData } from '@/types';

import { LogOut, ArrowRightLeft, Settings } from 'lucide-react';

interface UserMenuContentProps {
    user: User;
}

export function UserMenuContent({ user }: UserMenuContentProps) {
    const cleanup = useMobileNavigation();
    const { auth } = usePage<SharedData>().props;


    const handleLogout = () => {
        cleanup();
        router.flushAll();
    };

    return (
        <>
            <DropdownMenuLabel className="p-0 font-normal">
                <div className="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                    <UserInfo user={user} showEmail={true} />
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem asChild>
                    {(() => {
                        let routeName = "";
                        if (auth.user.role === "PEMINJAM") {
                            routeName = "profile.edit";
                        } else if (auth.user.role === "ADMIN") {
                            routeName = "admin.index";
                        } else if (auth.user.role === "PUSTAKAWAN") {
                            routeName = "admin.index";
                        }
                        return routeName ? (
                            <Link
                                className="block w-full"
                                href={route(routeName)}
                                as="button"
                                prefetch
                                onClick={cleanup}
                            >
                                <Settings className="mr-2" />
                                Settings
                            </Link>
                        ) : null;
                    })()}
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />

            {auth.user.role !== "PEMINJAM" && (
                <div>
                    <DropdownMenuGroup asChild>
                        <DropdownMenuItem asChild>
                            <Link className="block w-full" href={route('role')} as="button" prefetch onClick={cleanup}>
                                <ArrowRightLeft className="mr-2" />
                                Role
                            </Link>
                        </DropdownMenuItem>
                    </DropdownMenuGroup>
                    <DropdownMenuSeparator />
                </div>
            )}

            <DropdownMenuItem asChild>
                <Link className="block w-full" method="post" href={route('logout')} as="button" onClick={handleLogout}>
                    <LogOut className="mr-2" />
                    Log out
                </Link>
            </DropdownMenuItem>
        </>
    );
}
