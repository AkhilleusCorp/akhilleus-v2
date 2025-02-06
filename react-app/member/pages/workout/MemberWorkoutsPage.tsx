import React, {useState} from 'react';
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import {Link} from "react-router-dom";
import memberRoutes from "app/member/services/router/memberRoutes.tsx";
import MemberWorkoutsListFilters from "app/member/services/api/filters/MemberWorkoutsListFilters.tsx";
import MemberWorkoutsSearchForm from "app/member/features/workout/MemberWorkoutsSearchForm.tsx";
import MemberWorkoutListCard from "app/member/features/workout/MemberWorkoutListCard.tsx";

const MemberWorkoutsPage: React.FC = () => {
    const defaultFilters = new MemberWorkoutsListFilters();
    defaultFilters.status = ['planned', 'completed'];

    const [filters, setFilters] = useState<MemberWorkoutsListFilters>(defaultFilters);
    const [refreshKey, setRefreshKey] = useState(0)

    const handleWorkoutsSearch = (filtersFromForm: MemberWorkoutsListFilters) => {
        setFilters({
            ...filters,
            ...filtersFromForm
        });

        setRefreshKey(prev => prev + 1);
    }

    return (
        <MemberLayout>
            <h2>
                Workouts list
            </h2>

            <div className={"margin-bottom-s"}>
                <MemberWorkoutsSearchForm defaultFilters={defaultFilters} callbackFunction={handleWorkoutsSearch} />
            </div>

            <div className={"margin-bottom-s"}>
                <Link to={memberRoutes.workout.create}>Create New Workout</Link>
            </div>

            <MemberWorkoutListCard filters={filters} refreshKey={refreshKey}/>
        </MemberLayout>
    )
}

export default MemberWorkoutsPage;