<?php
// includes/db.php - JSON базасымен жұмыс істейтін класстар
class JsonDB {
    private $file;
    
    public function __construct($file = 'data/database.json') {
        $this->file = $file;
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([
                'users' => [],
                'student_profiles' => [],
                'teacher_profiles' => [],
                'courses' => [],
                'tests' => [],
                'files' => [],
                'grades' => [],
                'attendance' => []
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
    
    private function read() {
        return json_decode(file_get_contents($this->file), true);
    }
    
    private function write($data) {
        return file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    
    // Пайдаланушыларды басқару
    public function createUser($data) {
        $db = $this->read();
        $new_id = uniqid();
        $data['id'] = $new_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $db['users'][$new_id] = $data;
        return $this->write($db) ? $new_id : false;
    }
    
    public function getUserByUsername($username) {
        $db = $this->read();
        foreach ($db['users'] as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }
        return null;
    }
    
    public function getUserById($id) {
        $db = $this->read();
        return $db['users'][$id] ?? null;
    }
    
    // Профильдерді басқару
    public function saveProfile($user_id, $role, $data) {
        $db = $this->read();
        $key = $role . '_profiles';
        
        if (!isset($db[$key])) {
            $db[$key] = [];
        }
        
        $db[$key][$user_id] = array_merge(
            $db[$key][$user_id] ?? [],
            $data,
            ['updated_at' => date('Y-m-d H:i:s')]
        );
        
        return $this->write($db);
    }
    
    public function getProfile($user_id, $role) {
        $db = $this->read();
        $key = $role . '_profiles';
        return $db[$key][$user_id] ?? [];
    }
    
    // Файлдарды басқару
    public function saveFile($user_id, $file_data) {
        $db = $this->read();
        
        if (!isset($db['files'])) {
            $db['files'] = [];
        }
        
        $file_id = uniqid();
        $db['files'][$file_id] = [
            'user_id' => $user_id,
            'filename' => $file_data['filename'],
            'type' => $file_data['type'],
            'size' => $file_data['size'],
            'path' => $file_data['path'],
            'uploaded_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->write($db) ? $file_id : false;
    }
    
    public function getUserFiles($user_id) {
        $db = $this->read();
        $user_files = [];
        
        foreach ($db['files'] as $file_id => $file) {
            if ($file['user_id'] == $user_id) {
                $user_files[$file_id] = $file;
            }
        }
        
        return $user_files;
    }
    
    // Аватарды жаңарту
    public function updateAvatar($user_id, $avatar_url) {
        $db = $this->read();
        
        // Пайдаланушыны табу
        foreach ($db['users'] as &$user) {
            if ($user['id'] == $user_id) {
                $user['avatar'] = $avatar_url;
                $user['avatar_updated'] = date('Y-m-d H:i:s');
                break;
            }
        }
        
        return $this->write($db);
    }
    
    // Тест нәтижелерін сақтау
    public function saveTestResult($user_id, $course_id, $test_data) {
        $db = $this->read();
        
        if (!isset($db['tests'])) {
            $db['tests'] = [];
        }
        
        $test_id = uniqid();
        $db['tests'][$test_id] = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'score' => $test_data['score'],
            'total' => $test_data['total'],
            'percentage' => $test_data['percentage'],
            'answers' => $test_data['answers'] ?? [],
            'submitted_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->write($db) ? $test_id : false;
    }
    
    public function getUserTests($user_id) {
        $db = $this->read();
        $user_tests = [];
        
        foreach ($db['tests'] as $test_id => $test) {
            if ($test['user_id'] == $user_id) {
                $user_tests[$test_id] = $test;
            }
        }
        
        return $user_tests;
    }
    
    // Бағаларды сақтау
    public function saveGrade($student_id, $course_id, $grade_data) {
        $db = $this->read();
        
        if (!isset($db['grades'])) {
            $db['grades'] = [];
        }
        
        $grade_id = uniqid();
        $db['grades'][$grade_id] = [
            'student_id' => $student_id,
            'course_id' => $course_id,
            'grade' => $grade_data['grade'],
            'type' => $grade_data['type'],
            'comment' => $grade_data['comment'] ?? '',
            'created_by' => $grade_data['teacher_id'] ?? '',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->write($db) ? $grade_id : false;
    }
    
    public function getStudentGrades($student_id) {
        $db = $this->read();
        $grades = [];
        
        foreach ($db['grades'] as $grade_id => $grade) {
            if ($grade['student_id'] == $student_id) {
                $grades[$grade_id] = $grade;
            }
        }
        
        return $grades;
    }
    
    // Курстарды басқару
    public function createCourse($course_data) {
        $db = $this->read();
        
        if (!isset($db['courses'])) {
            $db['courses'] = [];
        }
        
        $course_id = uniqid();
        $db['courses'][$course_id] = [
            'id' => $course_id,
            'name' => $course_data['name'],
            'code' => $course_data['code'],
            'teacher_id' => $course_data['teacher_id'],
            'students' => $course_data['students'] ?? [],
            'description' => $course_data['description'] ?? '',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->write($db) ? $course_id : false;
    }
    
    public function getTeacherCourses($teacher_id) {
        $db = $this->read();
        $courses = [];
        
        foreach ($db['courses'] as $course_id => $course) {
            if ($course['teacher_id'] == $teacher_id) {
                $courses[$course_id] = $course;
            }
        }
        
        return $courses;
    }
    
    public function getStudentCourses($student_id) {
        $db = $this->read();
        $courses = [];
        
        foreach ($db['courses'] as $course_id => $course) {
            if (in_array($student_id, $course['students'])) {
                $courses[$course_id] = $course;
            }
        }
        
        return $courses;
    }
}

// Singleton үлгісі
class Database {
    private static $instance = null;
    private $db;
    
    private function __construct() {
        $this->db = new JsonDB('data/database.json');
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->db;
    }
}
?>