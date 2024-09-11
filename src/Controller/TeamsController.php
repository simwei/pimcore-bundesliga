<?php

namespace App\Controller;

use DateTime;
use Pimcore\Model\DataObject;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TeamsController extends FrontendController
{
    #[Route('/teams')]
    public function defaultAction(): Response
    {
        $teams = new DataObject\Team\Listing();
        $teams->load();

        return $this->render('teams/index.html.twig', ["teams" => $teams]);
    }

    #[Route('/team/{shortname}')]
    public function teamAction(Request $request): Response
    {
        $shortname = $request->get('shortname');
        $team = DataObject\Team::getByShortname($shortname, 1);

        if (!$team) {
            return $this->render('teams/error.team_not_found.html.twig');
        };

        $players = array_map(function ($player) {
            $from = $player->getBirthdate();
            $to   = new DateTime('today');
            $age = date_diff($from, $to)->y;

            $positionValues = DataObject\Service::getOptionsForSelectField($player, "Position");
            $position = $positionValues[$player->getPosition()];

            return [
                "name" => $player->getName(),
                "number" => $player->getNumber(),
                "age" => $age,
                "position" => $position,
            ];
        }, $team->getPlayers());

        // sort by player number
        usort($players, function ($a, $b) {
            if ($a["number"] == $b["number"]) {
                return 0;
            }
            return ($a["number"] < $b["number"]) ? -1 : 1;
        });


        return $this->render('teams/team.html.twig', ["team" => $team, "title" => $shortname, "players" => $players]);
    }
}
