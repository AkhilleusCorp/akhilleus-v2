import React from 'react';
import {useParams} from "react-router-dom";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import MemberLayout from "app/member/layouts/MemberLayout.tsx";
import MemberWorkoutPreviewCard from "app/member/features/workout/MemberWorkoutPreviewCard.tsx";
import useStartOneWorkoutById from "app/common/hooks/workout/useSartOneWorkoutById.tsx";

const MemberWorkoutTrainPage: React.FC = () => {
    const { workoutId } = useParams<{ workoutId: string }>();

    if (undefined == workoutId) {
        return <ErrorPage />
    }

    const workout = useStartOneWorkoutById(workoutId);
    if (!workout) {
        return <ErrorPage />
    }

    return (
        <MemberLayout>
            <MemberWorkoutPreviewCard workout={workout} />
        </MemberLayout>
    )
}

export default MemberWorkoutTrainPage;