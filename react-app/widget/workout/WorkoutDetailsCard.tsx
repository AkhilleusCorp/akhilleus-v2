import React from 'react';
import WorkoutDTO from "../../dtos/WorkoutDTO.tsx";
import EditButton from "../common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import DetailsButton from "../common/button/DetailsButton.tsx";
import Card from "../common/card/Card.tsx";
import CardSideImageBody from "../common/card/CardSideImageBody.tsx";
import CardFooter from "../common/card/CardFooter.tsx";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
    displayActions: boolean
}

const WorkoutDetailsCard: React.FC<WorkoutDetailsCardType> = ({ workout, displayActions }) => {
    return (
        <Card>
            <CardSideImageBody imageSrc={"https://placehold.co/150x150.png"} imageAlt={"Muscles overview"}>
                <h3 className={"card-title"}>{workout.name}</h3>
                <div className={"card-description"}>
                    <div>ID: {workout.id}</div>
                    <div>Status: {workout.status}</div>
                </div>
            </CardSideImageBody>

            <CardFooter shouldBeDisplayed={displayActions}>
                <DetailsButton routeToDetailsPage={websiteRoutes.workout.details(workout.id)}/>
                <EditButton routeToEditPage={websiteRoutes.workout.edit(workout.id)} />
            </CardFooter>
        </Card>
    );
}

export default WorkoutDetailsCard;