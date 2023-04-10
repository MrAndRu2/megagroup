
<?php

class MainController
{
    /**
     * Функция для обработки csv файла
     * @param file $file
     * @return array|string
     */
    public static function getUploadFile($file) : array|string
    {
        
        $stream = fopen($file['tmp_name'], "r");

        /** Делаем пропуск первой строки, смещая указатель на одну строку */ 
        fgetcsv($stream);

        $data = [];

        /** Читаем построчно содержимое CSV-файла */ 
        while ($row = fgetcsv($stream)) {
            $data[] = [
                'id' => $row[0],
                'parent_id' => $row[1],
                'name' => $row[2],
            ];
        }

        /** Сортируем полученные данные по возрастанию parent_id */
        usort($data, function (array $a, array $b): int {
            return $a['parent_id'] <=> $b['parent_id'];
        });


        $result = [];
        
        /** Создаем дерево */
        foreach ($data as ['id' => $id, 'parent_id' => $parent_id, 'name' => $name]) {
            $result[$id] = ['name' => $name];
            $result[$parent_id]['children'][$id] = &$result[$id];
        }

        return $data ? [$data[0]['id'] => $result[$data[0]['id']]] : 'Файл пуст';
    }
}
