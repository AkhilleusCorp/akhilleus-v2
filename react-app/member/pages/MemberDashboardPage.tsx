import React from 'react';
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import WorkoutsListFilters from "app/admin/services/api/filters/WorkoutsListFilters.tsx";
import MemberWorkoutListCard from "app/member/features/workout/MemberWorkoutListCard.tsx";

const MemberDashboardPage: React.FC = () => {
    const defaultFilters = new WorkoutsListFilters(10);

    return (
        <MemberLayout>
            <h1 className="text-3xl font-bold underline">
                <div>Member dashboard</div>
            </h1>

            <div className={"one-thirds-width"}>
                <MemberWorkoutListCard filters={defaultFilters} refreshKey={1}/>
            </div>
        </MemberLayout>
    );
}

export default MemberDashboardPage;