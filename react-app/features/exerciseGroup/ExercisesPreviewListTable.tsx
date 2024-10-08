import React from "react";
import {Table, TableBody, TableCell, TableContainer, TableRow} from "@mui/material";
import ExerciseDTO from "../../services/api/dtos/ExerciseDTO.tsx";

type ExercisesPreviewListTable = {
    exercises: ExerciseDTO[];
    hasMultipleMovement: boolean;
}

const ExercisesPreviewListTable: React.FC<ExercisesPreviewListTable> = ({exercises, hasMultipleMovement}) => {
    return (
        <TableContainer>
            <Table>
                <TableBody>
                { exercises.map((exercise: any) => (
                    <TableRow key={exercise.id}>
                        { hasMultipleMovement && (
                            <TableCell>{exercise.movementName}</TableCell>
                        )}

                        <TableCell>
                            Something
                        </TableCell>
                    </TableRow>
                ))}
                </TableBody>
            </Table>
        </TableContainer>
    )
}

export default ExercisesPreviewListTable;