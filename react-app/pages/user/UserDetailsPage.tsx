import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";
import UserPreviewCard from "app/features/user/UserPreviewCard.tsx";
import {useParams} from "react-router-dom";
import ErrorPage from "app/pages/ErrorPage.tsx";
import useGetOneUserById from "app/hooks/user/useGetOneUserById.tsx";
import UserLifecycleCard from "app/features/user/UserLifecycleCard.tsx";
import UserConfigurationCard from "app/features/user/UserConfigurationCard.tsx";

const UserDetailsPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();

    const user = useGetOneUserById(userId);
    if (!user) {
        return <ErrorPage />
    }

    return (
        <AdminLayout>
            <UserPreviewCard user={user} displayReadActions={false} displayWriteActions={true}/>

            <div className={"columns"}>
                <div className={"column half-width"}>
                    <UserLifecycleCard user={user}/>
                </div>

                <div className={"column half-width"}>
                    <UserConfigurationCard user={user}/>
                </div>
            </div>
        </AdminLayout>
    );
}

export default UserDetailsPage;