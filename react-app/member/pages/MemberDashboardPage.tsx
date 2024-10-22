import React from 'react';
import {Grid2 as Grid} from "@mui/material";
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import WorkoutsListFilters from "app/admin/services/api/filters/WorkoutsListFilters.tsx";
import WorkoutListCard from "app/member/features/workout/WorkoutListCard.tsx";

const MemberDashboardPage: React.FC = () => {
    const defaultFilters = new WorkoutsListFilters();

    return (
        <MemberLayout>
            <h1 className="text-3xl font-bold underline">
                <div>Member dashboard</div>
            </h1>

            <Grid>
                <WorkoutListCard filters={defaultFilters} refreshKey={1}/>
            </Grid>
        </MemberLayout>
    );
}

export default MemberDashboardPage;