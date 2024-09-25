import React from 'react';
import WorkoutDTO from "../../dtos/WorkoutDTO.tsx";
import EditButton from "../common/button/EditButton.tsx";
import routes from "../../infrastructure/router/routes-mapping.tsx";
import DetailsButton from "../common/button/DetailsButton.tsx";

type WorkoutDetailsCardType = {
    workout: WorkoutDTO,
    displayActions: boolean
}

const WorkoutDetailsCard: React.FC<WorkoutDetailsCardType> = ({ workout, displayActions }) => {
    return (
        <div>
            <div className={"card"}>
                <div className={"card-body"}>
                    <div className={"card-content"}>
                        <h3 className={"card-title"}>{workout.name}</h3>
                        <div className={"card-description"}>
                            <div>ID: {workout.id}</div>
                            <div>Status: {workout.status}</div>
                        </div>
                    </div>
                </div>

                {displayActions && (
                    <div className={"card-footer"}>
                        <DetailsButton routeToDetailsPage={routes.workout.details(workout.id)}/>
                        <EditButton routeToEditPage={routes.workout.edit(workout.id)} />
                    </div>
                )}

            </div>
        </div>
    );
}

export default WorkoutDetailsCard;