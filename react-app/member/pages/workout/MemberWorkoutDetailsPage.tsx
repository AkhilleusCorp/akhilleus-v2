import React from 'react';
import {useParams} from "react-router-dom";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import useGetOneWorkoutById from "app/common/hooks/workout/useGetOneWorkoutById.tsx";
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import MemberWorkoutPreviewCard from "app/member/features/workout/MemberWorkoutPreviewCard.tsx";

const MemberWorkoutDetailsPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();
    if (undefined == workoutId) {
        return <ErrorPage />
    }

    const workout = useGetOneWorkoutById(workoutId);

    if (!workout) {
        return <ErrorPage />
    }

    return (
        <MemberLayout>
            <MemberWorkoutPreviewCard workout={workout} />
        </MemberLayout>
    )
}

export default MemberWorkoutDetailsPage;