import React from "react";
import {Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import ExerciseDTO from "app/common/services/api/dtos/ExerciseDTO.tsx";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";
import MovementPropertyDTO from "app/common/services/api/dtos/MovementPropertyDTO.tsx";

type ExercisesPreviewListTable = {
    movementConfigs: IndexedArray;
    exercises: ExerciseDTO[];
}

const ExercisesPreviewListTable: React.FC<ExercisesPreviewListTable> = ({movementConfigs, exercises}) => {
    const headers: IndexedArray = {name: 'name', type: 'type'};
    const properties: IndexedArray = {type: 'type'};

    Object.keys(movementConfigs).forEach(movementConfigKey => {
        movementConfigs[movementConfigKey].trackedProperties.forEach((trackedProperty: MovementPropertyDTO) => {
            let header = trackedProperty.name;
            if (null !== trackedProperty.unit) {
                header += " (" + trackedProperty.unit + ")";
            }

            properties[trackedProperty.name] = trackedProperty.name;
            headers[trackedProperty.name] = header;
        });
    });

    if (Object.keys(movementConfigs).length === 1) {
        delete headers['name'];
    }

    return (
        <>
            <TableContainer>
                <Table>
                    <TableHead>
                        <TableRow>
                            { Object.entries(headers).map(([key, header]) => (
                                <TableCell key={key}>{ header }</TableCell>
                            ))}
                        </TableRow>
                    </TableHead>
                    <TableBody>
                    { exercises.map((exercise: any) => (
                        <TableRow key={exercise.id}>
                            {(Object.keys(movementConfigs).length > 1) &&
                                <TableCell>{exercise.name}</TableCell>
                            }
                            { Object.entries(properties).map(([key, property]) => (
                                <TableCell key={exercise.id + "-" + key}>{ exercise[property] }</TableCell>
                            ))}
                        </TableRow>
                    ))}
                    </TableBody>
                </Table>
            </TableContainer>
        </>
    )
}

export default ExercisesPreviewListTable;